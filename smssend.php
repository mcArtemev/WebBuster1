<?php
function sendFeedback($phone_id = 46764,
                      $region_name = 'Москва',
                      $model_type_name = 'неизвестно',
                      $brand_name = 'неизвестно',
                      $submit = 'sendform',
                      $tel = 'Телефон',
                      $name = 'Имя',
                      $comment = 'Вопрос')
{
    if(isset($_POST[$submit]))
    {
        $json = json_decode($_POST[$submit],true);

        $tel = $json['tel'];
        $name = $json['name'];
        $comm = $json[$comment];
        if (!empty($tel)) {
            $phone = (!empty($tel)) ? preg_replace('/[^0-9]/', '', $tel) : '';
            $_form = [];

            if (iconv_strlen($phone) !== 11) {
                echo json_encode(['message' => 'Вы указали некорректный номер телефона']);
                exit;
            }

            // ~~~~~~~~~~~~~~~~~CRM~~~~~~~~~~~~~~~~~~~
            $url = 'https://cibacrm.com/api_v2.php';
            $postdata = [
                'test' => 1,
                'key' => 'NZcRJPIaSyyZYBkSpLaO59pxHcviriN7',
                'method' => 'app_create',
                'source_id' => $phone_id,
                'phone' => htmlspecialchars($phone),
                'model_type_name' => $model_type_name,
                'brand_name' => $brand_name,
                'region_name' => $region_name,
                'name' => htmlspecialchars($name),
                'comment' => htmlspecialchars($comm),
            ];
            
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && empty($_POST['email']) && $phone) {
                // file_put_contents('file.json', print_r([$tel, $name, $comm], true), FILE_APPEND | LOCK_EX);
                return ['message' => 'Вы бот! Если нет, свяжитесь с Нами!'];
            }
            // file_put_contents('file.json', print_r([$tel, $name, $comm], true), FILE_APPEND | LOCK_EX);
            $post = http_build_query($postdata);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            $answer = curl_exec($ch);
            $answer = json_decode($answer, true);
            if($answer['status'] == 'success')
                $_form['message'] = 'Ваша заявка отправлена';
            else
                $_form['message'] = 'Ваша заявка не отправлена';
            // ~~~~~~~~~~~~~~~~~~END CRM~~~~~~~~~~~~~~~~~~~~~
        }
        else
            $_form['message'] = 'Введите номер телефона !';
    }   
    echo json_encode($_form);
    //return json_encode($_form);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
    echo sendFeedback()['message'];