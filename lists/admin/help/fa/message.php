در فیلد پیام میتوانید "متغیرها" را به کار برید، که با مقدار مناسبش برای کاربر جایگزین می‌شود:
<br />متغیرها باید به شکل <b>[NAME]</b> باشند که NAME را میتوان با نام ویژگی مورد نظر جایگزین نمود.
<br />برای مثال اگر ويژگی به نام  "First Name" دارید، در پیام، آنجا که می‌خواهید مقدار این ویژگی را نمایش دهید عبارت [FIRST NAME] را وارد کنید.
</p><p>در حال حاضر شما ویژگیهای زیر را تعریف کرده‌اید:
<table border=1><tr><td><b>ویژگی</b></td><td><b>جا نَما</b></td></tr>
<?php
$req = Sql_query("select name from {$tables["attribute"]} order by listorder");
while ($row = Sql_Fetch_Row($req))
  if (strlen($row[0]) < 20)
    printf ('<tr><td>%s</td><td>[%s]</td></tr>',$row[0],strtoupper($row[0]));
print '</table>';
if (phplistPlugin::isEnabled('rssmanager')) {
?>
  <p>می‌توانید الگوهایی را برای پیامهایی که به صورت RSS منتشر میشوند تنظیم کنید. برای انجام این کار زبانه "زمانبندی" را انتخاب کلیک کنید و تعداد دفعاتی را که میخواهید پیام فرستاده شود را مشخص کنید. پیام سپس برای فرستادن فهرست موارد به کاربرانی که در فهرست عضو هستند و آن فرکانس را تنظیم کرده اند، به کار گرفته خواهد شد. باید جانمای [RSS] را در پیامتان برای مشخص کردن جایی که فهرست باید در آنجا ظاهر شود به کار برید.</p>
<?php }
?>

<p>برای فرستادن محتوای یک برگه وب، محتوای زیر را به پیام اضافه کنید:<br/>
<b>[URL:</b>http://www.example.org/path/to/file.html<b>]</b></p>
<p>می‌توانید اطلاعات پایه کاربر را در این URL وارد کنید, نه اطلاعات ویژگی را:</br>
<b>[URL:</b>http://www.example.org/userprofile.php?email=<b>[</b>email<b>]]</b><br/>
</p>