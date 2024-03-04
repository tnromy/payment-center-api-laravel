<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Demo OAuth2 Example</title>
</head>
<body>
	
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>

<script>
	$('document').ready(function() {
		function parseUrl() {
    // Gunakan elemen <a> untuk memanfaatkan browser built-in parsing URL
    var link = document.createElement('a');
    link.href = window.location.href;

    // Dapatkan elemen-elemen URL
    var protocol = link.protocol; // "http:" atau "https:"
    var host = link.host; // "apisimpeg.tangerangselatankota.go.id"
    var path = link.pathname; // "/login/oauth2"
    var queryString = link.search; // "?state=ca1b744a2f7d72c9289ca2120bed4d25&session_state=efedbce0-c488-4bd0-8123-b1fdd3020068&code=04935941-0618-413c-b310-5ff1472fd52c.efedbce0-c488-4bd0-8123-b1fdd3020068.abdf016b-7372-4972-9487-af19a4e7de59"

    // Parsir parameter-parameter dari query string
    var params = {};
    var queryParams = queryString.substring(1).split('&');
    for (var i = 0; i < queryParams.length; i++) {
      var pair = queryParams[i].split('=');
      params[pair[0]] = pair[1];
    }

   return params;

    // Anda juga dapat mengembalikan nilai-nilai ini atau melakukan operasi lain sesuai kebutuhan.
  } // end function parseUrl

      function getAccessToken() {
        let apiUrl = "{{ env('APP_URL') }}/api/login/oauth2-token";

let data = {
  "code": parseUrl()["code"],
  "state": parseUrl()["state"],

};

 axios.post(apiUrl, data).then(response => {
    // Tanggapan sukses
// simpan response.data ke local storage
    localStorage.setItem('access_token', response.data.auth.access_token);
    localStorage.setItem('expires', response.data.auth.expires);
        // Contoh: simpan juga data pengguna ke local storage jika diperlukan
        localStorage.setItem('user', JSON.stringify(response.data.user));
    })
    .catch(error => {
    // Tanggapan error
    console.error(error);
    }); // end axios then catch
} // end function getAccessToken

getAccessToken();
	});
</script>
</body>
</html>