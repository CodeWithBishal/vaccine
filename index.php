<?php
session_start();
session_regenerate_id();
$search = "<a class='btn btn-primary' href=''>Search for a new pin code</a>";
$search_new = "<a class='btn btn-primary' href=''>Refresh</a>";
$date = date("d-m-y");


if(isset($_POST['submit'])){
  $Pincode = htmlspecialchars($_POST['pincode']);
  // Api link starts 
    $link = "https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/calendarByPin?pincode=";
    $link .= $Pincode;
    $link .= "&date=";
    $link .= $date;
 }

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $link,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$response = json_decode($response, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Check your nearest Vaccination Center and Slot Availability">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.2/tailwind.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="canonical" href="https://codewithbishal.com/vaccine">
	  <link rel="apple-touch-icon" sizes="180x180" href="https://codewithbishal.com/logo/apple-touch-icon.png"><link rel="icon" type="image/png" sizes="32x32" href="https://codewithbishal.com/logo/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="https://codewithbishal.com/logo/favicon-16x16.png"><link rel="manifest" href="https://codewithbishal.com/logo/site.webmanifest">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-181718210-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-181718210-2');
</script>
    <title>Vaccine | Code With Bishal</title>
    <style>
    .cookie-btn{
        background-color: rgba(54, 54, 238, 0.897) !important;
    }
    [disabled="disabled"]{
        cursor:not-allowed;
    }
    hr, #social{
        display: none !important;
    }
    footer{
            margin-top: 30% !important;
        }
    #data{
      display: none;
    }
    div#scroll{
      display: none;
    }
    @media only screen and (max-width: 600px) {
      div#scroll{
      display: block;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }
    #data::-webkit-scrollbar {
      all:unset !important;
    }
}
    </style>
</head>
<body>
<header class="text-gray-700 body-font">
<?php
define('Myheader', TRUE);
require ('header.php');
?>
</header>
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Vaccination</h1>
<?php 
if($Pincode){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Showing Results for '.$Pincode.' &nbsp; &nbsp; '.$search.'
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
echo '<style> #data{display:block;} #pin-code-search, .g-recaptcha{display:none;} .px-5, .py-24{padding: 0;}</style>';
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  To refresh the Search Results please click refresh&nbsp; &nbsp; '.$search_new.'
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}
?>
<?php if(isset($failed)){
echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
'.$failed.'
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}
?>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base" id="text-description">Check your nearest Vaccination Center and Slot Availability</p>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base" id="text-description">Note: All the data are being fetched from Co-WIN public API</p>
    </div>
    <div class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end" id="pin-code-search">
      <div class="relative flex-grow w-full">
      <form action="" method="POST" id="pin" autocomplete="off" class="needs-validation" novalidate>
        <input type="number" id="pincode" name="pincode" class="form-control" placeholder="Please enter your Pin code here" min="100000" max="999999" required autofocus>
        <div class="invalid-feedback">Please provide a valid Pincode.</div>
      </div>
      <div class="modal fade" id="gcaptcha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please fill the CAPTCHA to continue</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="g-recaptcha" data-sitekey="6LdhON0aAAAAAIp6c5VdZhntOAymRET1POsnDMBK" data-callback="enableBtn" data-expired-callback="disableBtn"></div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submit" id="submit" title="Please fill the CAPTCHA to continue" disabled="disabled">Submit</button>
      </div>
    </div>
  </div>
</div>
      <button type="button" data-toggle="modal" data-target="#gcaptcha" class="btn btn-primary btn-lg">Search</button>
    </div>
    </form>
  </div>
</section>
<section id="data">
<div class="container my-4">
<div class="text-center" id="scroll">
  <i class="fas fa-arrow-left fa-3x"></i>
  <h1>Scroll</h1>
  <i class="fas fa-arrow-right fa-3x"></i>
</div>
    <table class="table table-bordered text-center table-hover" id="myTable">
      <thead>
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Location</th>
          <th scope="col">Available Vaccine</th>
          <th scope="col">Vaccine</th>
          <th scope="col">Minimum Age Limit</th>
        </tr>
      </thead>
      <tbody>
<?php
foreach($response['centers'] as $list ){
  foreach($list['sessions'] as $value) {
          $book = '<a class="btn btn-success" href="https://www.cowin.gov.in/home" title="Click to register" target="_blank" rel="noopener noreferrer">&nbsp';
          $book .= $value['available_capacity'];
          $book .= "</a>";
          if($value['available_capacity'] =='0'){
            $available_capacity = "<span class='btn btn-danger'>0 (All Booked)</span>";
          }
          else{
            $available_capacity = $book;
          }
          echo "
          <tr>
          <td>".$value['date']."</td>
          <td>".$list['name']."</td>
          <td>".$available_capacity."</td>
          <td>".$value['vaccine']."</td>
          <td>".$value['min_age_limit']."</td>
          </tr>
          ";
        }
      }
      ?>
      </tbody>
    </table>
    <div class="text-center" id="scroll">
      <i class="fas fa-arrow-left fa-3x"></i>
      <h1>Scroll</h1>
      <i class="fas fa-arrow-right fa-3x"></i>
    </div>
  </div>
  <hr>

</section>
<script>
if($(window).width()<768){
    $("#myTable").addClass("table-responsive");
} 
else {
    $("#myTable").removeClass("table-responsive");
}
</script>
<script src="https://codewithbishal.com/js/mini/form-val.min.js" defer></script>
<script src="https://codewithbishal.com/js/mini/autosave.min.js"></script>
<script src="https://codewithbishal.com/js/mini/captcha.min.js" defer></script>
<script src="https://codewithbishal.com/js/mini/load.min.js" defer></script>
<script>
  saveStorage('#pin');
</script>
<footer class="page-footer font-small unique-color-dark">
<?php
define('Myfooter', TRUE);
require ('footer.php');
?>
</footer>
<hr>
</body>
</html>