<?php
// header('Access-Control-Allow-Origin: *');
include_once('../includes/crud.php');
$db = new Database();
include_once('../library/jwt.php');
include_once('../includes/custom-functions.php');
$fn = new custom_functions();

function generate_token($payload = [])
{
    $jwt = new JWT();
    if (empty($payload)) {
        $payload = [
            'iat' => time(),
            /* issued at time */
            'iss' => 'eKart',
            'exp' => time() + (30 * 60),
            /* expires after 1 minute */
            'sub' => 'eKart Authentication',
            'web' => '33201609',
            'app' => '31977632'
        ];
    }

    $token = $jwt::encode($payload, JWT_SECRET_KEY);
    return $token;
}

function verify_token()
{
    $jwt = new JWT();
    $fn = new custom_functions;
    try {
        //    echo "Token : ".$token = $jwt->getBearerToken();
        $token = $jwt->getBearerToken();
    } catch (Exception $e) {
        $response['error'] = true;
        $response['message'] = $e->getMessage();
        print_r(json_encode($response));
        return false;
    }
    if (!empty($token)) {
        try {
            // JWT::$leeway = 60;
            $payload = $jwt->decode($token, JWT_SECRET_KEY, ['HS256']);
            if (!isset($payload->iss) || $payload->iss != 'eKart') {
                $response['error'] = true;
                $response['message'] = 'Invalid Hash';
                print_r(json_encode($response));
                return false;
            } else {

                /** web */
                // if (isset($payload->web) && $payload->web == '33201609') {
                //     /* fetch doctor_brown web and match item id here*/
                //     $purchase_code = $fn->get_settings('doctor_brown_web');
                //     $cal_time_check = $time_check = '';
                //     if (!empty($purchase_code)) {
                //         $isAuthWeb = json_decode($purchase_code);
                //         $time_check = $isAuthWeb->time_check;
                //         $token_web = trim($isAuthWeb->dr_firestone);
                //     }

                //     if ($token_web == '33201609') {
                //         return true;
                //     } else {

                //         $response['error'] = true;
                //         $response['message'] = 'Web purchase is not verified! Kindly check your purchase code registration!';
                //         print_r(json_encode($response));
                //         return false;
                //     }
                // }

                /** app */
                // if (isset($payload->app) && $payload->app == '31977632') {
                //     /* fetch doctor_brown app*/
                //     $purchase_code = $fn->get_settings('doctor_brown');
                //     $cal_time_check = $time_check = '';
                //     if (!empty($purchase_code)) {
                //         $isAuthApp = json_decode($purchase_code);
                //         $time_check = $isAuthApp->time_check;
                //         $token_app = trim($isAuthApp->dr_firestone);
                //     }

                //     if ($token_app == '31977632') {
                //         return true;
                //     } else {

                //         $response['error'] = true;
                //         $response['message'] = 'App purchase is not verified! Kindly check your purchase code registration!';
                //         print_r(json_encode($response));
                //         return false;
                //     }
                // }

                /** ----------------------------------------------------------------------------- */
                $purchase_code_web = (null !== $fn->get_settings('doctor_brown_web')) ? $fn->get_settings('doctor_brown_web') : "";
                $purchase_code_app = (null !== $fn->get_settings('doctor_brown')) ? $fn->get_settings('doctor_brown') : "";


                /** if both app and web registerd */
                if (!empty($purchase_code_web) && !empty($purchase_code_app)) {
                    if (isset($purchase_code_web) && !empty($purchase_code_web) && isset($purchase_code_app) && !empty($purchase_code_app)) {
                        $isAuthWeb = isset($purchase_code_web) ? json_decode($purchase_code_web) : "";
                        $time_check = isset($isAuthWeb->time_check) ? $isAuthWeb->time_check : "";
                        $token_web = isset($isAuthWeb->dr_firestone) ? trim($isAuthWeb->dr_firestone) : "";

                        $isAuthApp = isset($purchase_code_app) ? json_decode($purchase_code_app) : "";
                        $time_check = isset($isAuthApp->time_check) ? $isAuthApp->time_check : "";
                        $token_app = isset($isAuthApp->dr_firestone) ? trim($isAuthApp->dr_firestone) : "";

                        if ($token_web == '33201609' && $token_app == '31977632') {
                            return true;
                        } else {

                            $response['error'] = true;
                            $response['message'] = 'System purchase is not verified! Kindly check your purchase code registration!';
                            print_r(json_encode($response));
                            return false;
                        }
                    }
                }


                /** if only one registerd from app and web */
                if (!empty($purchase_code_web) || !empty($purchase_code_app)) {
                    /** web */
                    if (isset($purchase_code_web) && !empty($purchase_code_web)) {
                        $isAuthWeb = isset($purchase_code_web) ? json_decode($purchase_code_web) : "";
                        $time_check = isset($isAuthWeb->time_check) ? $isAuthWeb->time_check : "";
                        $token_web = isset($isAuthWeb->dr_firestone) ? trim($isAuthWeb->dr_firestone) : "";
                        if ($token_web == '33201609') {
                            return true;
                        } else {

                            $response['error'] = true;
                            $response['message'] = 'Web purchase is not verified! Kindly check your purchase code registration!';
                            print_r(json_encode($response));
                            return false;
                        }
                    }

                    /** app */
                    if (isset($purchase_code_app) && !empty($purchase_code_app)) {
                        $isAuthApp = isset($purchase_code_app) ? json_decode($purchase_code_app) : "";
                        $time_check = isset($isAuthApp->time_check) ? $isAuthApp->time_check : "";
                        $token_app = isset($isAuthApp->dr_firestone) ? trim($isAuthApp->dr_firestone) : "";
                        if ($token_app == '31977632') {
                            return true;
                        } else {

                            $response['error'] = true;
                            $response['message'] = 'App purchase is not verified! Kindly check your purchase code registration!';
                            print_r(json_encode($response));
                            return false;
                        }
                    }
                } else {
                    $response['error'] = true;
                    $response['message'] = 'System purchase is not verified! Kindly check your purchase code registration!';
                    print_r(json_encode($response));
                    return false;
                }

                // return true;
            }
        } catch (Exception $e) {
            $response['error'] = true;
            $response['message'] = $e->getMessage();
            print_r(json_encode($response));
            return false;
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Unauthorized access not allowed";
        print_r(json_encode($response));
        return false;
    }
}