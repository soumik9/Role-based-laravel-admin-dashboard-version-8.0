<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<style type="text/css" media="screen">
	html {
		width:100%
	}
	::-moz-selection {
		background:#fd4326;
		color:#fff;
		text-shadow:1px 1px 0 #f22b0e
	}
	::selection {
		background:#fd4326;
		color:#fff;
		text-shadow:1px 1px 0 #f22b0e
	}
	body {
		font-family: 'arial';
		background-color:#fff;
		margin:0;
		padding:0
	}
</style>


<table width="100%" style="min-height: 400px; padding: 50px; margin: 0; background: linear-gradient(180deg, #1b5a90, #006266); color: #fff">
  
  <tr>
    <td style="width: 100%; text-align: center;">

		@if(empty($setting->website_logo_light))
			<img src="{{asset('/assets/admin/img/logo-def.png')}}" style="width: 120px;">
		@else
			<img src="{{$setting->website_logo_light}}" style="width: 120px;">
		@endif


		<h3>Forget Password Email</h3>
		<p>You can reset password from bellow link: <a href="{{ route('reset.password.get', $token) }}">Reset Password</a></p>
    </td>
  </tr> 

</table>