<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
		<link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
		<link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
		<link rel="stylesheet" href="css/icheck/skins/flat/blue.css" >
		<link rel="stylesheet" href="css/main.css" media="screen" >
		<script src="js/modernizr/modernizr.min.js"></script>
		

<style>
	.container {
		text-align: center;
	}

	button {
		padding: 10px 20px;
		font-size: 18px;
	}
</style>
</head>
<body>
<div class="container">
	            <div class="login-bg-color bg-black-300" style="background-image:url('images/background-image.jpg');background-size:cover;background-position:center;">
	                <div class="row" >
	                    <div class="col-md-4 col-md-offset-4">
	                        <div class="panel login-box">
	                            <div class="panel-heading">
	                                <div class="panel-title text-center">
	                                    <h4> Result Management System</h4>
	                                </div>
	                            </div>
	                            <div class="panel-body p-20">
<button onclick="authenticateUser()" title="Authenticate a previously enrolled user on this application">Authenticate Student</button>
	                                <hr>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
</div>
<div id="faceio-modal"></div>
<script src="https://cdn.faceio.net/fio.js"></script>
<script type="text/javascript">
	const faceio = new faceIO("fioaaaea");
	function enrollNewUser() {
		faceio.enroll({
			"locale": "auto",
			"userConsent": false,
			"payload": {
				"whoami": 123456,
				"email": "john.doe@example.com"
			}
		}).then(userInfo => {
			// User Successfully Enrolled!
			alert(
			`User Successfully Enrolled! Details:
			Unique Facial ID: ${userInfo.facialId}
			Enrollment Date: ${userInfo.timestamp}
			Gender: ${userInfo.details.gender}
			Age Approximation: ${userInfo.details.age}`
			);
			console.log(userInfo);
		}).catch(errCode => {
			handleError(errCode);
			faceio.restartSession();
		});
	}
	function authenticateUser() {
		faceio.authenticate({
			"locale": "auto"
		}).then(userData => {
			console.log("Success, user recognized")
			console.log("Linked facial Id: " + userData.facialId)
			console.log("Associated Payload: " + JSON.stringify(userData.payload))
      window.location.replace("http://127.0.0.1/Faceio/student-result-management/find-result.php");
		}).catch(errCode => {
			handleError(errCode);
			faceio.restartSession();
		});
	}
	function handleError(errCode) {
		switch (errCode) {
			case fioErrCode.PERMISSION_REFUSED:
				console.log("Access to the Camera stream was denied by the end user");
				break;
			case fioErrCode.NO_FACES_DETECTED:
				console.log("No faces were detected during the enroll or authentication process");
				break;
			case fioErrCode.UNRECOGNIZED_FACE:
				console.log("Unrecognized face on this application's Facial Index");
				break;
			case fioErrCode.MANY_FACES:
				console.log("Two or more faces were detected during the scan process");
				break;
			case fioErrCode.FACE_DUPLICATION:
				console.log("User enrolled previously (facial features already recorded). Cannot enroll again!");
				break;
			case fioErrCode.PAD_ATTACK:
				console.log("Presentation (Spoof) Attack (PAD) detected during the scan process");
				break;
			case fioErrCode.FACE_MISMATCH:
				console.log("Calculated Facial Vectors of the user being enrolled do not matches");
				break;
			case fioErrCode.WRONG_PIN_CODE:
				console.log("Wrong PIN code supplied by the user being authenticated");
				break;
			case fioErrCode.PROCESSING_ERR:
				console.log("Server side error");
				break;
			case fioErrCode.UNAUTHORIZED:
				console.log("Your application is not allowed to perform the requested operation (eg. Invalid ID, Blocked, Paused, etc.). Refer to the FACEIO Console for additional information");
				break;
			case fioErrCode.TERMS_NOT_ACCEPTED:
				console.log("Terms & Conditions set out by FACEIO/host application rejected by the end user");
				break;
			case fioErrCode.UI_NOT_READY:
				console.log("The FACEIO Widget could not be (or is being) injected onto the client DOM");
				break;
			case fioErrCode.SESSION_EXPIRED:
				console.log("Client session expired. The first promise was already fulfilled but the host application failed to act accordingly");
				break;
			case fioErrCode.TIMEOUT:
				console.log("Ongoing operation timed out (eg, Camera access permission, ToS accept delay, Face not yet detected, Server Reply, etc.)");
				break;
			case fioErrCode.TOO_MANY_REQUESTS:
				console.log("Widget instantiation requests exceeded for freemium applications. Does not apply for upgraded applications");
				break;
			case fioErrCode.EMPTY_ORIGIN:
				console.log("Origin or Referer HTTP request header is empty or missing");
				break;
			case fioErrCode.FORBIDDDEN_ORIGIN:
				console.log("Domain origin is forbidden from instantiating fio.js");
				break;
			case fioErrCode.FORBIDDDEN_COUNTRY:
				console.log("Country ISO-3166-1 Code is forbidden from instantiating fio.js");
				break;
			case fioErrCode.SESSION_IN_PROGRESS:
				console.log("Another authentication or enrollment session is in progress");
				break;
			case fioErrCode.NETWORK_IO:
			default:
				console.log("Error while establishing network connection with the target FACEIO processing node");
				break;
		}
	}
</script>
</body>
</html>
