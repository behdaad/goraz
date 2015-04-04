<!doctype html>
<html dir="rtl">
	<head>
		<meta charset="utf-8" />
		<title>
			اینا میان
		</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<!-- <link rel="apple-touch-icon" href="/img/apple-touch-icon.png" /> -->
	</head>
	<body>
		<div id="container">
			<?php
				$username = $_POST["username"];
				$password = $_POST["password"];
				$emptyForm = true;
				$isComing = false;
				if ($_POST["isComing"] == "true")
				{
					$isComing = true;
					$emptyForm = false;
				}
				elseif ($_POST["isComing"] == "false")
				{
					$isComing = false;
					$emptyForm = false;
				}

				$combined = $username . " " . $password . "\n";
				// echo $combined;

				// check validity
				$db = fopen("db/db.txt", "r") or die("Unable to open file.");
				$isValid = false;
				$number = 0;
				while (!feof($db))
				{
					$line = fgets($db);
					$dbLine = explode(" ", $line);
					$credTest = $dbLine[1] . " " . $dbLine[2] . "\n";

					if ($credTest == $combined)
					{
						$isValid = true;
						$number = intval($dbLine[0]);
						// echo $number;
					}
				}

				if ($isValid)
				{
					if ($isComing)
					{
						$contents = file_get_contents('db/db.txt');
						$contents_arr = explode("\n", $contents);
						$wantedLine_arr = explode(" ", $contents_arr[$number]);
						if ($wantedLine_arr[5] == "yes") // already said is coming
						{
							echo "<span id=\"danger\">";
							echo "چند بار می‌گی داداچ؟";
							echo "</span>";
						}
						elseif (numberOfComing() >= 15)
						{
							echo "<span id=\"danger\">";
							echo "شرمنده داداچ، پر شده.";
							echo "</span>";
						}
						else
						{
							$wantedLine = $wantedLine_arr[0] . " " . $wantedLine_arr[1] . " " . $wantedLine_arr[2] . " " . $wantedLine_arr[3] . " " . $wantedLine_arr[4] . " " . "yes";
							$contents_arr[$number] = $wantedLine;
							file_put_contents('db/db.txt', implode("\n", $contents_arr));
							$numberOfComing++;
						}
					}
					else
					{
						$contents = file_get_contents('db/db.txt');
						$contents_arr = explode("\n", $contents);
						$wantedLine_arr = explode(" ", $contents_arr[$number]);
						if ($wantedLine_arr[5] == "no")
						{
							echo "<span id=\"danger\">";
							echo "اصلاً مگه قرار بود بیای؟ :|";
							echo "</span>";
						}
						else
						{
							$wantedLine = $wantedLine_arr[0] . " " . $wantedLine_arr[1] . " " . $wantedLine_arr[2] . " " . $wantedLine_arr[3] . " " . $wantedLine_arr[4] . " " . "no";
							$contents_arr[$number] = $wantedLine;
							file_put_contents('db/db.txt', implode("\n", $contents_arr));
						}
					}
				}
				elseif (!$emptyForm)
				{
					echo "<span id=\"danger\">";
					echo "اشتبا زدی داداچ.";
					echo "</span>";
				}

				function numberOfComing()
				{
					$sum = 0;
					$fileContents = file_get_contents('db/db.txt');
					$contents_arr = explode("\n", $fileContents);
					// $wantedLine_arr = explode(" ", $contents_arr[$number]);
					foreach ($contents_arr as $line)
					{
						//echo "line: " . $line;
						$line_arr = explode(" ", $line);
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
					$file = fopen("db/db.txt", "r");
					while (!feof($file))
					{
						$line = fgets($file);
						$line_arr = explode(" ", $line);

						if ($line_arr[5] == "yes\n")
						{
							echo "<li>";
							echo $line_arr[3] . " " . $line_arr[4] . " ";
							echo "<img src=\"img/yes.png\" class=\"icon\" />";
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
					$file = fopen("db/db.txt", "r");
					while (!feof($file))
					{
						$line = fgets($file);
						$line_arr = explode(" ", $line);
						if ($line_arr[5] == "no\n")
						{
							echo "<li>";
							echo $line_arr[3] . " " . $line_arr[4] . " ";
							echo "<img src=\"img/no.png\" class=\"icon\" />";
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
				<a href="index.html">
					همون صفحه قبلیه
				</a>
			</p>
		</div>
		<footer>
			۲۰۱۵ &copy; بهداد
		</footer>
	</body>
</html>
