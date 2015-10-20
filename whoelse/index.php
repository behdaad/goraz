<!doctype html>
<html dir="rtl">
	<head>
		<meta charset="utf-8" />
		<title>
			اینا میان
		</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="shortcut icon" href="../img/icon/favicon.ico" type="image/x-icon" />
	</head>
	<body id="whoElse">
		<div id="container">
			<?php
				$usernameInput = $_POST["username"];
				$username = str_replace(".", "", $usernameInput);
				$emptyForm = true;
				$isComing = false;
				if ($_POST["isComing"] == "true")
					$isComing = true;

				elseif ($_POST["isComing"] == "false")
					$isComing = false;

				if ($username == "")
					$emptyForm = true;
				else
					$emptyForm = false;

				$usernameHash = hash("md5", $username);
				if ($usernameHash == "221303f9c3aecfd50da04952a2a3a0bd")
				{
					copy("../db/db_original.txt", "../db/db.txt");
					// exit()
				}
				else
				{
					// check validity
					$db = fopen("../db/db.txt", "r") or die("Unable to open file.");
					$isValid = false;
					$number = 0;
					while (!feof($db))
					{
						$line = fgets($db);
						$dbLine = explode(",", $line);
						if ($dbLine[1] == $username)
						{
							$isValid = true;
							$number = intval($dbLine[0]);
						}
					}

					if ($isValid && !$emptyForm)
					{
						if ($isComing)
						{
							$contents = file_get_contents('../db/db.txt');
							$contents_arr = explode("\n", $contents);
							$wantedLine_arr = explode(",", $contents_arr[$number]);
							if ($wantedLine_arr[4] == "yes") // already said is coming
							{
								echo "<span id=\"red\">";
								echo "چند بار می‌گی داداچ؟";
								echo "</span>";
							}
							elseif (numberOfComing() >= 15)
							{
								echo "<span id=\"red\">";
								echo "شرمنده داداچ، پر شده.";
								echo "</span>";
							}
							else
							{
								$wantedLine = $wantedLine_arr[0] . "," . $wantedLine_arr[1] . "," . $wantedLine_arr[2] . "," . $wantedLine_arr[3] . "," . "yes";
								$contents_arr[$number] = $wantedLine;
								file_put_contents('../db/db.txt', implode("\n", $contents_arr));

								echo "<span id=\"green\">";
								echo "تلباس تویی، کعبه و بت‌خانه بهانه...";
								echo "</span>";
							}
						}
						elseif (!$isComing)
						{
							$contents = file_get_contents('../db/db.txt');
							$contents_arr = explode("\n", $contents);
							$wantedLine_arr = explode(",", $contents_arr[$number]);
							if ($wantedLine_arr[4] == "no" && !$emptyForm)
							{
								echo "<span id=\"red\">";
								echo "اصلاً مگه قرار بود بیای؟ :|";
								echo "</span>";
							}
							else
							{
								$wantedLine = $wantedLine_arr[0] . "," . $wantedLine_arr[1] . "," . $wantedLine_arr[2] . "," . $wantedLine_arr[3] . "," . "no";
								$contents_arr[$number] = $wantedLine;
								file_put_contents('../db/db.txt', implode("\n", $contents_arr));

								echo "<span id=\"red\">";
								echo "می‌اومدی حالا :(";
								echo "</span>";
							}
						}
					}
					elseif (!$emptyForm)
					{
						echo "<span id=\"red\">";
						echo "اشتبا زدی داداچ.";
						echo "</span>";
					}
				}

				function numberOfComing()
				{
					$sum = 0;
					$fileContents = file_get_contents('../db/db.txt');
					$contents_arr = explode("\n", $fileContents);
					// $wantedLine_arr = explode(",", $contents_arr[$number]);
					foreach ($contents_arr as $line)
					{
						//echo "line: " . $line;
						$line_arr = explode(",", $line);
						if ($line_arr[5] == "yes")
							$sum++;
					}
					return $sum;
				}
			?>
			<p>
				اینا میان:
			</p>
			<ol class="people" id="coming">
				<?php
					$file = fopen("../db/db.txt", "r");
					while (!feof($file))
					{
						$line = fgets($file);
						$line_arr = explode(",", $line);

						if ($line_arr[4] == "yes\n")
						{
							if ($line_arr[1] == "mmiq2004")
								echo "<li id=\"nejat\">";
							else
								echo "<li>";
							echo $line_arr[2] . " " . $line_arr[3] . " ";
							echo "<img src=\"../img/yes.png\" class=\"icon\" />";
							echo  "</li>\n";
						}
					}
					fclose($file);
				?>
			</ol>
			<p>
				اینام نمیان:
			</p>
			<ol class="people" id="notComing">
				<?php
					$file = fopen("../db/db.txt", "r");
					while (!feof($file))
					{
						$line = fgets($file);
						$line_arr = explode(",", $line);
						if ($line_arr[4] == "no\n")
						{
							if ($line_arr[1] == "nejat")
								echo "<li id=\"nejat\">";
							else
								echo "<li>";
							echo $line_arr[2] . " " . $line_arr[3] . " ";
							echo "<img src=\"../img/no.png\" class=\"icon\" />";
							echo  "</li>\n";
						}
					}
					fclose($file);
				?>
			</ol>
			<!--ol class="people" id="notAnswered">
				<?php
					// $notAnsweredFile = fopen("db/notAnswered.txt", "r");
					// while (!feof($notAnsweredFile))
					// {
					// 	$
					// 	echo "<li>" . fgets($notAnsweredFile) . "</li>";
					// 	echo "<img src=\"img/maybe.png\" class=\"icon\" />";
					// }
					// fclose($notAnsweredFile);
				?>
			</ol-->
			<p>
				<a href="..">
					همون صفحه قبلیه
				</a>
			</p>
		</div>
		<footer>
			۲۰۱۵ &copy; بهداد
		</footer>
	</body>
</html>
