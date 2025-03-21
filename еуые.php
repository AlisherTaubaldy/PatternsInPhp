<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

use Bitrix\Main\Application;


//todo убрать валидацию с необязательных полей когда будет верстка

/*ПРОИЗВОДИМ ЗАПРОС НА GOOGLE СЕРВИС И ЗАПИСЫВАЕМ ОТВЕТ*/
$Return = getCaptcha($_POST['g-recaptcha-response']);

/*ЕСЛИ ЗАПРОС УДАЧНО ОТПРАВЛЕН И ЗНАЧЕНИЕ score БОЛЬШЕ 0,5 ВЫПОЛНЯЕМ КОД*/
if ($Return->success == true && $Return->score > 0.5) {

    $request = Application::getInstance()->getContext()->getRequest();
    $valid = true;

    if (!empty($request->getPost("MALL"))) {
        $mall = explode('|', $request->getPost("MALL"));
        $PROP['MALL'] = clean($mall[1]);
        $PROP_ANOTHER_ID['MALL'] = clean($mall[0]);
        $validFlag['MALL'] = true;
    }
    if (!empty($request->getPost("BRAND"))) {
        $PROP['BRAND'] = clean($request->getPost("BRAND"));
        $validFlag['BRAND'] = true;
    }
//Если не пустое "Другое" значет выбралие его и не берем значение с <textarea
    if (!empty($request->getPost("CATEGORY")) || !empty($request->getPost("CATEGORY_ANOTHER"))) {
        $category = explode('|', $request->getPost("CATEGORY"));
        $PROP['CATEGORY'] = !empty($request->getPost("CATEGORY_ANOTHER")) ? $request->getPost("CATEGORY_ANOTHER") : clean($category[1]);
        $PROP_ANOTHER_ID['CATEGORY_ANOTHER'] = clean($request->getPost("CATEGORY"));
        $validFlag['CATEGORY'] = true;
    }
    if (!empty($request->getPost("COUNTRY"))) {
        $PROP['COUNTRY'] = clean($request->getPost("COUNTRY"));
        $validFlag['COUNTRY'] = true;
    }
    if (!empty($request->getPost("FORM_BRANDS")) || !empty($request->getPost("FORM_BRANDS_ANOTHER"))) {
        $brands = explode('|', $request->getPost("FORM_BRANDS"));
        $PROP['FORM_BRANDS'] = !empty($request->getPost("FORM_BRANDS_ANOTHER")) ? $request->getPost("FORM_BRANDS_ANOTHER") : clean($brands[1]);
        $PROP_ANOTHER_ID['FORM_BRANDS_ANOTHER'] = clean($request->getPost("FORM_BRANDS"));
        $validFlag['FORM_BRANDS'] = true;
    }
    if (!empty($request->getPost("NUMBER_STORES"))) {
        $PROP['NUMBER_STORES'] = clean($request->getPost("NUMBER_STORES"));
//    $validFlag['NUMBER_STORES'] = true;
    }
    if (!empty($request->getPost("PRICE_SEGMENT"))) {
        $segment = explode('|', $request->getPost("PRICE_SEGMENT"));
        $PROP['PRICE_SEGMENT'] = clean($segment[1]);
        $validFlag['PRICE_SEGMENT'] = true;
    }
    if (!empty($request->getPost("SIMILAR_BRANDS"))) {
        $PROP['SIMILAR_BRANDS'] = clean($request->getPost("SIMILAR_BRANDS"));
//    $validFlag['SIMILAR_BRANDS'] = true;
    }
    if (!empty($request->getPost("STORE_AREA_MIN"))) {
        $PROP['STORE_AREA_MIN'] = clean($request->getPost("STORE_AREA_MIN"));
//    $validFlag['STORE_AREA_MIN'] = true;
    }
    if (!empty($request->getPost("STORE_AREA_MAX"))) {
        $PROP['STORE_AREA_MAX'] = clean($request->getPost("STORE_AREA_MAX"));
//    $validFlag['STORE_AREA_MAX'] = true;
    }
    if (!empty($request->getPost("PRICE"))) {
        $PROP['PRICE'] = clean($request->getPost("PRICE"));
        $validFlag['PRICE'] = true;
    }
//Презентация бренда
//ссылка
    if (!empty($request->getPost("BRAND_PRESENTATION_LINK"))) {
        $PROP['BRAND_PRESENTATION_LINK'] = clean($request->getPost("BRAND_PRESENTATION_LINK"));
    }
//файл
    if ($_FILES['BRAND_PRESENTATION']) {
        $files = [];
        foreach ($_FILES['BRAND_PRESENTATION']['name'] as $index => $name) {
            $files["n" . $index] = [
                "VALUE" => array(
                    "error" => $_FILES['BRAND_PRESENTATION']['error'][$index],
                    "name" => $_FILES['BRAND_PRESENTATION']['name'][$index],
                    "size" => $_FILES['BRAND_PRESENTATION']['size'][$index],
                    "tmp_name" => $_FILES['BRAND_PRESENTATION']['tmp_name'][$index],
                    "type" => $_FILES['BRAND_PRESENTATION']['type'][$index]
                )
            ];
        }
        $PROP['BRAND_PRESENTATION'] = $files;
    }
//Фотографии существующих магазинов
//ссылка
    if (!empty($request->getPost("SHOP_PHOTOS_LINK"))) {
        $PROP['SHOP_PHOTOS_LINK'] = clean($request->getPost("SHOP_PHOTOS_LINK"));
    }
//файл
    if ($_FILES['SHOP_PHOTOS']) {
        $files = [];
        foreach ($_FILES['SHOP_PHOTOS']['name'] as $index => $name) {
            $files["n" . $index] = [
                "VALUE" => array(
                    "error" => $_FILES['SHOP_PHOTOS']['error'][$index],
                    "name" => $_FILES['SHOP_PHOTOS']['name'][$index],
                    "size" => $_FILES['SHOP_PHOTOS']['size'][$index],
                    "tmp_name" => $_FILES['SHOP_PHOTOS']['tmp_name'][$index],
                    "type" => $_FILES['SHOP_PHOTOS']['type'][$index]
                )
            ];
        }
        $PROP['SHOP_PHOTOS'] = $files;
    }
    if (!empty($request->getPost("FIO"))) {
        $PROP['FIO'] = clean($request->getPost("FIO"));
        $validFlag['FIO'] = true;
    }
//email
    if (!empty($request->getPost("EMAIL"))) {
        $PROP['EMAIL'] = clean($request->getPost("EMAIL"));
        if (filter_var($PROP['EMAIL'], FILTER_VALIDATE_EMAIL)) {
            $validFlag['EMAIL'] = true;
        }
    }
    if (!empty($request->getPost("PHONE"))) {
        $PROP['PHONE'] = clean($request->getPost("PHONE"));
        $validFlag['PHONE'] = true;
    }
    if (!empty($request->getPost("WORK_PHONE"))) {
        $PROP['WORK_PHONE'] = clean($request->getPost("WORK_PHONE"));
        $validFlag['WORK_PHONE'] = true;
    }

//Валидация
//if ($validFlag['MALL'] &&
//    $validFlag['BRAND'] &&
//    $validFlag['CATEGORY'] &&
//    $validFlag['COUNTRY'] &&
//    $validFlag['FORM_BRANDS'] &&
//    $validFlag['NUMBER_STORES'] &&
//    $validFlag['PRICE_SEGMENT'] &&
//    $validFlag['SIMILAR_BRANDS'] &&
//    $validFlag['STORE_AREA_MIN'] &&
//    $validFlag['STORE_AREA_MAX'] &&
//    $validFlag['PRICE'] &&
//    $validFlag['FIO'] &&
//    $validFlag['EMAIL'] &&
//    $validFlag['PHONE'] &&
//    $validFlag['WORK_PHONE']) {
//    $valid = true;
//}

//debug($PROP);
//var_dump($valid);

    if ($valid) {
        $el = new CIBlockElement;

        $arLoadProductArray = array(
            "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
            "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
            "IBLOCK_ID" => LESSEE_IB,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => 'ФИО: ' . $PROP["FIO"],
            "ACTIVE" => "Y",            // активен
        );

        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {

            //получаем ссылки на прикрепленные файлы у элемента
            $arFilter = ["IBLOCK_ID" => LESSEE_IB, "ID" => $PRODUCT_ID, "ACTIVE" => 'Y'];
            $res = CIBlockElement::GetList([], $arFilter, false, [], ['ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_*']);
            while ($ob = $res->GetNextElement()) {

                $newElement = [
                    'FIELDS' => $ob->GetFields(),
                    'PROPERTIES' => $ob->GetProperties(),
                ];
            }

            //формируем ссылки най прикрепленные файлы презентации бренда/брендов
            $PROP["BRAND_PRESENTATION"] = [];
            foreach ($newElement['PROPERTIES']['BRAND_PRESENTATION']['VALUE'] as $id) {
                $brandUrlString .= 'https://tspm.kz' . CFile::GetPath($id) . ', ';
//            $PROP["BRAND_PRESENTATION"][] =  'https://tspm.kz'.CFile::GetPath($id);
            }

            //формируем ссылки най прикрепленные файлы фотографии существующих магазинов
            $PROP["SHOP_PHOTOS"] = [];
            foreach ($newElement['PROPERTIES']['SHOP_PHOTOS']['VALUE'] as $id) {
                $shopUrlString .= 'https://tspm.kz' . CFile::GetPath($id) . ', ';
//            $PROP["SHOP_PHOTOS"][] =  'https://tspm.kz'.CFile::GetPath($id);
            }

            $response = [
                'new_id' => $PRODUCT_ID,
                'message' => 'success',
                'error' => '',
            ];

            //Отправляем данные клиенту на API
            //Доп.поле от клиента 'field_3261' => 2 - Dostyk Plaza, 3 - Shymkent Plaza
            if ($PROP['MALL'] == 'Dostyk Plaza'){
                $idMallApi = 2;
            } elseif ($PROP['MALL'] == 'Shymkent Plaza'){
                $idMallApi = 3;
            }

            $items = array();
            $items[] = array(
                'field_3243' => '1587',
                'field_1123' => '1090',
                'field_3261' => $idMallApi,
                'field_2756' => $PROP_ANOTHER_ID['MALL'], //1631 - Dostyk Plaza/ 1632 - Shymkent Plaza
                'field_1124' => $PROP['BRAND'], //String
                'field_607' => $PROP_ANOTHER_ID['CATEGORY_ANOTHER'], //571 - Супермаркет
                //  7004 - аптека/оптика
                // 7005 -	женская одежда
                // 7006 -	кинотеатр
                // 584- 	кожгалантерея
                // 875 - 	косметика/парфюмерия
                // 587 - 	кофейня/ресторан
                // 591 - 	магазин электроники и бытовой техники
                // 7007 -	мужская и женская одежда
                // 574 - 	мужская, женская, детская одежда
                // 7008 -	мужская одежда
                // 7009 -	обувь/аксессуары
                // 586 -	подарки/аксессуары
                // 7010 -	развлекательная зона
                // 7011 - 	спортивные товары
                // 571 - 	супермаркет
                // 595 - 	товары для детей
                // 872 - 	товары для дома
                // 604 - 	услуги
                // 7012 - 	фуд-корт
                // 3131 -	другое


                'field_7558' => $PROP['COUNTRY'], // String
                'field_7559' => $PROP_ANOTHER_ID['FORM_BRANDS_ANOTHER'], // String
                'field_7560' => $PROP['NUMBER_STORES'],
                'field_7562' => $PROP['PRICE_SEGMENT'], // String
                'field_7561' => $PROP['SIMILAR_BRANDS'],
                'field_3257' => $PROP['STORE_AREA_MIN'], //String
                'field_3258' => $PROP['STORE_AREA_MAX'], //String
                'field_3122' => $PROP['PRICE'], // Средний чек String
                'field_7557' => !empty($PROP['BRAND_PRESENTATION_LINK']) ? $PROP['BRAND_PRESENTATION_LINK'] : $brandUrlString, // Абсолютные пути до файла через запятую
                'field_7556' => !empty($PROP['SHOP_PHOTOS_LINK']) ? $PROP['SHOP_PHOTOS_LINK'] : $shopUrlString, // Абсолютные пути до фото через запятую
                'field_3246' => $PROP['FIO'], // String
                'field_3322' => $PROP['EMAIL'], //String
                'field_3321' => $PROP['PHONE'], // String
                'field_3320' => $PROP['WORK_PHONE'] //String
            );


            $params = array(
                'key' => 'ADnr03LaTyjG2UOqnLIa3ojzC24r3BROYr1qnnh6', //API ключ
                'username' => 'slonworks', //Имя пользователя
                'password' => 'WNsIHrWW0Q', //Пароль
                'action' => 'insert', //действие
                'entity_id' => 49, //ID сущности, в которую будет добавлена запись
                'items' => $items, //массив записей
            );

//        $ch = curl_init(LESSEE_API_URL); //API Url
            $ch = curl_init('http://online.tsd.kz/api/rest.php'); //API Url
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $result = curl_exec($ch);
            curl_close($ch);

//        debug($result);
//        debug(json_decode($result, true));

            $response = [
                'new_id' => $PRODUCT_ID,
                'api_response' => $result,
                'recaptcha' => $Return,
                'message' => '',
                'error' => '',
            ];
            //Логируем ответ
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/local/ajax/log/lessee.txt', date('d.m.y H:i:s').' '. json_encode($response) . PHP_EOL, FILE_APPEND);
            echo json_encode($response);

//        if ($result) {
//            $result = json_decode($result, true);
//
//            print_r($result);
//        }

//        echo json_encode($response);
        } else {
            $response = [
                'new_id' => $PRODUCT_ID,
                'message' => 'error',
                'error' => $el->LAST_ERROR,
            ];
            echo json_encode($response);
        };
    }

} else {
    $result = ['success' => false, 'message' => "You are Robot", 'res' => $Return];
    echo json_encode($result);
}
