<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Controller;

use App\Response\ErrorResponse;
use App\Response\SuccessResponse;
use App\Service\AccountService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Exception\Exception;

class AccountController extends AbstractController
{

    /**
     * Send a request to submitting login credentials to iCloud.
     *
     * @Route("/api/account/login")
     *
     * @link project://docs/services/account/login.md
     * @param Request $request
     * @param AccountService $accountService
     * @return JsonResponse
     */
    public function login(
        Request $request,
        AccountService $accountService
    )
    {
        try {
            $accountService->login(
                (string)$request->query->get("email", ""),
                (string)$request->query->get("password", "")
            );
            return new SuccessResponse();
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }

    /**
     * Send a request to logout from iCloud.
     *
     * @Route("/api/account/logout")
     *
     * @link project://docs/services/account/logout.md
     * @param AccountService $accountService
     * @return JsonResponse
     */
    public function logout(
        AccountService $accountService
    )
    {
        try {
            $accountService->logout();

            return new SuccessResponse();
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }

    /**
     * Send a request to submitting the 2-factor-code to iCloud.
     *
     * @Route("/api/account/submit_code")
     *
     * @link project://docs/services/account/submit-code.md
     * @param Request $request
     * @param AccountService $accountService
     * @return JsonResponse
     */
    public function submitCode(
        Request $request,
        AccountService $accountService
    )
    {
        try {
            $accountService->submitCode(
                $request->query->get("code")
            );

            return new SuccessResponse();
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }

    /**
     * Send a request to trust the client. This will skip multi factor authorization in the future.
     *
     * @Route("/api/account/trust_device")
     *
     * @link project://docs/services/account/trust-device.md
     * @param AccountService $accountService
     * @return JsonResponse
     */
    public function trustDevice(
        AccountService $accountService
    )
    {
        try {
            $accountService->trustDevice();
            return new SuccessResponse();
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }

    /**
     * Send a request to check if multi factor authentication for the login process is required.
     *
     * @Route("/api/account/check_mfa")
     *
     * @link project://docs/services/account/check-mfa.md
     * @param AccountService $accountService
     * @return JsonResponse
     */
    public function checkMultiFactorAuthentication(
        AccountService $accountService
    )
    {
        try {
            return new SuccessResponse([
                "requires2FA" => $accountService->checkMultiFactorAuthentication()
            ]);
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }

    /**
     * @Route("/api/account/validate_session")
     *
     * @link project://docs/services/account/validate-session.md
     * @param AccountService $accountService
     * @return JsonResponse
     */
    public function validateSession(
        AccountService $accountService
    )
    {
        try {
            $accountService->validateSession();

            return new SuccessResponse();
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }
}
