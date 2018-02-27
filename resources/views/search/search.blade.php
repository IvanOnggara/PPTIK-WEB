<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Search Sertifikat</title>
      <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('searchaset/css/style.css')}}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
<h1 class="text-center" style="font-weight: bold;color: white;">CEK VALIDASI SERTIFIKAT</h1>
  <div class="search open">
      <input type="search" class="search-box" name="searchdata" id="searchdata" onKeyDown="if(event.keyCode==13) showResult();"/>
  <span class="search-button" id="search-button">
    <span class="search-icon"></span>

  </span>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1 class="text-center" style="color: white;font-weight: bold;">Result</h1>
      <div id="result">
          
      </div>
      
    </div>
  </div>
</div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('searchaset/js/index.js')}}"></script>
    <script type="text/javascript">
      function showResult() {
        var str = document.getElementById('searchdata').value;

        if (str.length == 0) { 
            document.getElementById("result").innerHTML = "<h1 class='text-center' style='color:white;'>-</h1>";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("result").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "search?k=" + str, true);
            xmlhttp.send();
        }
      }
    </script>
</body>
</html>
