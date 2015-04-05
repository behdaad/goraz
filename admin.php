<!doctype html>
<html dir="rtl">
	<head>
		<meta charset="utf-8" />
		<title>پیج خفن</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<!-- <link rel="apple-touch-icon" href="/img/apple-touch-icon.png" /> -->
	</head>
	<body>
		<div id="container">
			<?php
				$filled = false;
				if ($filledAdminForm == "true")
				{
					$filled = true;
					echo "true";
				}

				$username = $_POST["username"];
				$password = $_POST["password"];

				if (!$filled)
				{
					echo "<form name=\"adminLogin\" action=\"admin.php\" method=\"post\">";
					echo "<label for=\"username\" class=\"box\">";
					echo "اسم" ;
					echo "</label>";
					echo "<input type=\"text\" name=\"username\" id=\"username\" />";
					echo "<br />";

					echo "<label for=\"password\" class=\"box\">";
					echo "فلان";
					echo "</label>";
					echo "<input type=\"password\" name=\"password\" id=\"password\" />";
					echo "<br />";
					
					echo "<button type=\"submit\" name=\"filledAdminForm\" value=\"true\">داخل شو</button>";
					echo "<br />";
					echo "</form>";
				}
				else
				{
					if ($username == "admin" && $password == "")
					{

					}
					else
					{
						echo "<span id=\"red\">";
						echo "خجالت بکش";
						echo "</span>";
					}
				}
			?>
		</div>
		<footer>
			۲۰۱۵ &copy; <a href="admin.php" id="admin">بهداد</a>
		</footer>
	</body>
</html>
