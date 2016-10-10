<?php
$file = realpath('phonedata.'.basename( $_GET['filter']));
if (!is_readable($file)) {
  $file = '/var/www/sites/psyop/internal/phonedata.all';
  $file = '/home/beef23/wellingtonfan.com/internal/phonedata.all';
}
$users = file($file);
header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s', filemtime($file)-3600) . ' GMT' );
header('Cache-Control: max-age=20' );
?>
<!doctype html>
<html lang="en" manifest="/internal/cache.appcache">
<head>
<title>Psyop Phones</title>
<meta charset="utf-8">
<meta name="author"    content="wfan@psyop.tv, copyright: Psyop, Inc.">
<meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<link rel="stylesheet" type="text/css" href="media/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="media/bootstrap.css">
<link rel="stylesheet" type="text/css" href="media/user_manager.css">
<link rel="stylesheet" type="text/css" href="media/bootstrap-responsive.css">

<link rel="icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
<link rel="apple-touch-icon" href="/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114-precomposed.png">

<style>
.dataTables_filter {
    float:none;
    text-align: center;
}
</style>
</head>
<body style="padding:0;margin:0;padding-top:4px;">
    <table id="user_list" style="width:100%; margin:0;" class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($users as $user) :
      list($office, $name, $phone, $email) = explode("\t", $user);
      // http://www.rfc-base.org/rfc-3966.html: "tel:" URI
      $rfc3966 = preg_replace('/\D/', '', $phone);
      $email = trim($email);
?>
<tr>
<td><a href="mailto:<?=htmlspecialchars($email)?>"><?=htmlspecialchars($name)?></a></td>
<td><a href="tel:<?=htmlspecialchars($rfc3966)?>"><?=htmlspecialchars($phone)?></a></td>
</tr>
<?php endforeach; ?>

        </tbody>
    </table><!-- /#user_list -->

    <script type="text/javascript" src="media/jquery.min.js"></script>
    <script type="text/javascript" src="media/bootstrap.min.js"></script>
    <script type="text/javascript" src="media/jquery.dataTables.min.js" charset="utf-8"></script>
    <script type="text/javascript">
    $(function() {
        $('#user_list').dataTable({"bPaginate": false});
    })
    </script>
</body>
</html>
