<?php 

function responseJsonForPaginate($data) {
	$url = request()->fullUrlWithoutQuery('page');
        $data->setPath($url);

        $data = $data->toArray();
        $data["result"] = $data["data"];
        unset($data["data"]);
        $data["status"] = [
                    "http_status_code" =>200,
                    "http_status_message" => "OK"
                ];

                return $data;
}

function responseJsonOk($data) {
      return response()->json([
                "status" => [
                    "http_status_code" =>200,
                    "http_status_message" => "OK"
                ],
                "result" => $data
            ]);
}

function responseJsonError400($data) {
      return response()->json( [
                'status' => [
                    'http_status_code' => 400,
                    'http_status_message' => 'Bad Request'
                ],
                'errors' => $data,
            ], 400 );
}