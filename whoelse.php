<!doctype html>
<html dir="rtl">
	<head>
		<meta charset="utf-8" />
		<title>
			اینا میان
		</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
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

						// echo "contets: " . $contents;
						// echo "arr: " . $contents_arr . "<br />";

						// foreach ($contents_arr as $con)
						// {
						// 	echo $con . "<br />";
						// }
						// echo "wanted arr: " . $wantedLine_arr . "<br />";
						// echo "look at me: " . $wantedLine_arr[0] . "<br />";
						$wantedLine = $wantedLine_arr[0] . " " . $wantedLine_arr[1] . " " . $wantedLine_arr[2] . " " . $wantedLine_arr[3] . " " . $wantedLine_arr[4] . " " . "yes";
						$contents_arr[$number] = $wantedLine;
						file_put_contents('db/db.txt', implode("\n", $contents_arr));
					}
					else
					{
						$contents = file_get_contents('db/db.txt');
						$contents_arr = explode("\n", contents);
						$wantedLine_arr = explode(" ", $contents_arr[$number]);
						$wantedLine = $wantedLine_arr[0] . " " . $wantedLine_arr[1] . " " . $wantedLine_arr[2] . " " . $wantedLine_arr[3] . " " . $wantedLine_arr[4] . " " . "no";
						$contents_arr[$number] = $wantedLine;
						file_put_contents('db/db.txt', implode("\n", $contents_arr));
					}
				}
				elseif (!$emptyForm)
				{
					echo "<span id=\"wrongPassword\">";
					echo "اشتبا زدی داداچ.";
					echo "</span>";
				}

				function changeToYes($line)
				{
					if (stristr($line, "No"))
					{
						return "replaement line!\n";
					}
					return $data;
				}

				function changeToNo($data)
				{
					if (stristr($data, 'certain word'))
					{
						return "replaement line!\n";
					}
				return $data;
				}
			?>
			<p>
				اینا میان:
			</p>
			<ol class="people" id="coming">
				<?php
					// $isComingFile = fopen("db/isComing.txt", "r");
					// while (!feof($isComingFile))
					// {
					// 	$string = fgets($isComingFile);
					// 	if ($string != "")
					// 	{
					// 		echo "<li>\n" . $string;
					// 		echo "\n<img src=\"img/yes.png\" class=\"icon\" />";
					// 		echo "</li>\n";
					// 	}
					// }
					// fclose($isComingFile);
				?>
			</ol>
			<p>
				اینام نمیان:
			</p>
			<ol class="people" id="notComing">
				<?php
					// $notComingFile = fopen("db/notComing.txt", "r");
					// while (!feof($notComingFile))
					// {
					// 	$string = fgets($notComingFile);
					// 	if ($string != "")
					// 	{
					// 		echo "<li>\n" . $string;
					// 		echo "\n<img src=\"img/no.png\" class=\"icon\" />";
					// 		echo "</li>\n";
					// 	}
					// }
					// fclose($notComingFile);
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
			 &copy; 2015 بهداد (جلوش) و امیر (پشتش)
		</footer>
	</body>
</html>
