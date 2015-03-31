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

				// check validity
				$db = fopen("db/db.txt", "r") or die("Unable to open file.");
				$isValid = false;
				while (!feof($db))
				{
					$line = fgets($db);
					if ($line == $combined)
						$isValid = true;
				}

				if ($isValid)
				{
					if ($isComing)
					{
						$isComingFile = fopen("db/isComing.txt", "a");
						fwrite($isComingFile, $username . "\n");
						fclose($isComingFile);
						// check if previously answered
						// check if not full
					}
					else
					{
						$notComingFile = fopen("db/notComing.txt", "a");
						fwrite($notComingFile, $username . "\n");
						fclose($notComingFile);
						// check if previously answered
						// check if not full
					}
				}
				elseif (!$emptyForm)
				{
					echo "<span id=\"wrongPassword\">";
					echo "اشتباه زدی برادر.";
					echo "</span>";
				}
			?>
			<p>
				اینا میان:
			</p>
			<ol class="people" id="coming">
				<?php
					$isComingFile = fopen("db/isComing.txt", "r");
					while (!feof($isComingFile))
					{
						$string = fgets($isComingFile);
						if ($string != "")
						{
							echo "<li>\n" . $string;
							echo "\n<img src=\"img/yes.png\" class=\"icon\" />";
							echo "</li>\n";
						}
					}
					fclose($isComingFile);
				?>
			</ol>
			<p>
				اینام نمیان:
			</p>
			<ol class="people" id="notComing">
				<?php
					$notComingFile = fopen("db/notComing.txt", "r");
					while (!feof($notComingFile))
					{
						$string = fgets($notComingFile);
						if ($string != "")
						{
							echo "<li>\n" . $string;
							echo "\n<img src=\"img/no.png\" class=\"icon\" />";
							echo "</li>\n";
						}
					}
					fclose($notComingFile);
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
