<!doctype html>
<html dir="rtl">
	<head>
		<meta charset="utf-8" />
		<title>پسووردتو می‌خوای عوض کنی؟</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body>
		<div id="container">
			<?php
				$username = $_POST["username"];
				$oldPassword = $_POST["oldPassword"];
				$newPassword1 = $_POST["newPassword1"];
				$newPassword2 = $_POST["newPassword2"];
				$filledForm = false;
				if ($_POST["filledForm"] == "true")
				{
					$filledForm = true;
				}

				$combined = $username . " " . $oldPassword . "\n";

				$error = false;
				if ($username == "" && $oldPassword == "" && $newPassword1 == "" && $newPassword2 == "" && $filledForm) // empty form
				{
					echo "<span id=\"red\">";
					echo "خالی خالی؟";
					echo "</span>";
					$error = true;
				}
				elseif ($username == "" && $filledForm)
				{
					echo "<span id=\"red\">";
					echo "قسمت یورزنیم رو هم باید پر کنیا.";
					echo "</span>";
					$error = true;
				}
				elseif (($newPassword1 != $newPassword2) && $filledForm)
				{
					echo "<span id=\"red\">";
					echo "اگه نمی‌تونی دو دفعه پشت هم بزنی پسووردو، لازم نیست عوض کنی اصلاً :|";
					echo "</span>";
					$error = true;
				}

				if (!$error && $filledForm)
				{
					// check validity
					$db = fopen("db/db.txt", "r") or die("Unable to open file.");
					$isValid = false;
					$number = 0;
					while (!feof($db))
					{
						$line = fgets($db);
						$dbLine = explode(" ", $line);
						$credTest = $dbLine[1] . " " . $dbLine[2] . "\n";
						// echo "cred: " . $credTest . "<br />";
						if ($credTest == $combined)
						{
							$isValid = true;
							$number = intval($dbLine[0]);
						}
					}

					if ($isValid)
					{
						$contents = file_get_contents('db/db.txt');
						$contents_arr = explode("\n", $contents);
						$wantedLine_arr = explode(" ", $contents_arr[$number]);
						$wantedLine = $wantedLine_arr[0] . " " . $wantedLine_arr[1] . " " . $newPassword1 . " " . $wantedLine_arr[3] . " " . $wantedLine_arr[4] . " " . $wantedLine_arr[5];
						$contents_arr[$number] = $wantedLine;
						file_put_contents('db/db.txt', implode("\n", $contents_arr));

						echo "<span id=\"green\">";
						echo "تلباس";
						echo "</span>";
					}
					else
					{
						echo "<span id=\"red\">";
						echo "اشتبا زدی داداچ.";
						echo "</span>";
					}
				}
			?>
			<form name="changepassword" action="changepassword.php" method="post">
				<label for="username" class="box">
					اسم 
				</label>
				<input type="text" name="username" id="username" />
				<br />

				<label for="password" class="box">
					قدیمیه
				</label>
				<input type="password" name="oldPassword" id="oldPassword" />
				<br />

				<label for="password" class="box">
					جدیده
				</label>
				<input type="password" name="newPassword1" id="newPassword1" />
				<br />

				<label for="password" class="box">
					دوباره
				</label>
				<input type="password" name="newPassword2" id="newPassword2" />
				<br />
				
				<button type="submit" name="filledForm" value="true">آره؟ آره.</button>
				<br />
			</form>
			<a href="index.html">
					نمی‌خوام عوض کنم اصلاً.
			</a>
		</div>
		<footer>
			۲۰۱۵ &copy; <a href="admin.php" id="admin">بهداد</a>
		</footer>
	</body>
</html>