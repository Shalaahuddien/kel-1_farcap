@extends('layouts.main')
@section('container')
    <h1>Silahkan sampaikan aspirasi anda !</h1>
    <div style="color: red" class="" id="error"></div>
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="masukkan nama">
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" class="form-control" name="email" id="email" placeholder="masukkan email">
    </div>
      <div class="form-group">
        <label for="address">Alamat</label>
        <textarea class="form-control" name="address" id="address" rows="3" rows="10"></textarea>
      </div>
      <div class="form-group">
        <label for="telephone">Nomor Telepon</label>
        <input type="text" class="form-control" name="telephone" id="telephone" placeholder="masukkan nomor telepon">
      </div>
      <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" class="form-control" name="photo" id="photo" placeholder="masukkan photo" onchange="loadFile(event)">
      </div>
      <div class="form-group">
        <label for="message">Pesan</label>
        <textarea  class="form-control" name="message" id="message" rows="3" rows="10"></textarea>
      </div>

          <div class="form-group mt-4 mb-4">
            <div class="captcha">
                <span>{!! captcha_img() !!}</span>
                <button type="button" class="btn btn-danger" class="reload" id="reload">
                    &#x21bb;
                </button>
            </div>
        </div>
        
        <div class="form-group mb-4">
            <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
        </div>

    <img id="output">
    <button onclick="add()" class="btn btn-primary">Submit</button>

    </form>

      <script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>

    <script>
        var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <script>
        function add() {


            let name = $("#name").val()
            let email = $("#email").val()
            let address = $("#address").val()
            let telephone = $("#telephone").val()
            let message = $("#message").val()
            let captcha = $("#captcha").val()
            let photo = $("#photo")[0].files[0]


            if(name == "") return alert("nama tidak boleh kosong")
            if(email == "") return alert("email tidak boleh kosong")
            if(address == "") return alert("alamat tidak boleh kosong")
            if(telephone == "") return alert("nomor telepon tidak boleh kosong")
            if(message == "") return alert("pesan tidak boleh kosong")

            let fd = new FormData();
            fd.append("name",name)
            fd.append("email",email)
            fd.append("address",address)
            fd.append("telephone",telephone)
            if (photo) fd.append("photo",photo)
            fd.append("message",message)
            fd.append("captcha",captcha)
            $.ajax({
              url : "http://127.0.0.1:8000/api/aspiration",
              method : "POST",
              data : fd,
              processData : false,
              contentType : false,
              success : _ => {
                  window.location.href = "http://127.0.0.1:8000/aspiration"
                },
              error: (err) => {
                console.log(err);
                console.log(...fd);
                $('#error').html('Data tidak valid');
              },
            })
        }
    </script>
@endsection
