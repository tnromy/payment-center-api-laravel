<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mail Cyber Center | Contact</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/icons/fontawesome6/css/fontawesome.css">
  <style>
    .loading-container {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 9999;
    }
  </style>
</head>
<body>
  <!-- Loading Animation -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Contact</h5>
            <div class="table-responsive">
              <table class="table table-striped" id="table-contacts">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>WhatsApp</th>
                    <th>Telegram</th>
                    <th>Tel</th>
                    <th>Address Detail</th>
                    <th>Postal Code</th>
                    <th>Location Code</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Data will be filled dynamically -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content -->
  
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/icons/fontawesome6/js/fontawesome.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>

<script>
  $('document').ready(function() {
       function getAuth() {
      if (localStorage.getItem('access_token') == null) {
        window.location.href = '/login'
      } // end if access_token == null

      var auth = {
        user: JSON.parse(localStorage.getItem('user')),
        access_token: localStorage.getItem('access_token'),
        expires: localStorage.getItem('eexpires'),
      };

      return auth; // end return
    } // end function getAuth

    console.log(getAuth().expires);

        function headerRequest() {
    return {
          headers: {
              Authorization: 'Bearer ' + getAuth().access_token
          }
        };
   } // end function headerRequest

      window.genContactActionElem = function(id) {
    return `
    <div class="d-flex">
        <a class="btn btn-primary me-2 shadow btn-xs sharp" data-bs-toggle="offcanvas" href="/#offcanvasExample" role="button" aria-controls="offcanvasExample" onclick="window.setAddEditContactModal(true, `+ id +`)"><i class="fa fa-pencil"></i></a>
        <button type="button" class="btn btn-danger shadow btn-xs sharp" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" onclick="window.setSelectedContact(`+ id +`)">
                          <i class="fa fa-trash"></i>
                        </button>
    </div>
`;
} // end genContactActionElem

      function getContacts() {
        let apiUrl = "{{ env('APP_URL') }}/api/contacts";

 axios.get(apiUrl, headerRequest()).then(response => {
    // Tanggapan sukses
// simpan response.data ke local storage
   // response.data berisi list contact
  let contacts = response.data.result;
          let tableBody = $('#table-contacts tbody');
          tableBody.empty();
          $.each(contacts, function(index, contact) {
            let row = $('<tr>');
            row.append('<td>' + (index + 1) + '</td>');
            row.append('<td>' + contact.full_name + '</td>');
            row.append('<td>' + contact.email + '</td>');
            row.append('<td>' + contact.phone + '</td>');
            row.append('<td>' + contact.whatsapp + '</td>');
            row.append('<td>' + contact.telegram + '</td>');
            row.append('<td>' + contact.tel + '</td>');
            row.append('<td>' + contact.addr_detail + '</td>');
            row.append('<td>' + contact.addr_pos_code + '</td>');
            row.append('<td>' + contact.location_code + '</td>');
            row.append('<td>' + window.genContactActionElem(contact.id) + '</td>');
            tableBody.append(row);
          });
    })
    .catch(error => {
    // Tanggapan error
    console.error(error);
    }); // end axios then catch
} // end function getContacts

getContacts();
  });
</script>

</body>
</html>
