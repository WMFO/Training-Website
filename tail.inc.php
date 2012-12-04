                        <br class="clearfix" />
                </div>

</div>
		<div id="sidebar">
<?php
require_once("./includes/connection.inc.php");
$sidebar = dbConnect('read');
$sql = "SELECT * FROM cmstext WHERE name = 'sidebar'";
$result = $sidebar->query($sql);
$line = $result->fetch_assoc();
echo $line['body'];
?>
			<h3>wmfo training system</h3>
			<p>
                        The WMFO Training Education Management System (the TEMS&reg;) was built in the summer of 2012 by Nicholas Andre.
</p>
<p><i> It's like SIS, but not terrible.	</i>
			</p>
		</div>
		<br class="clearfix" />
	</div>
</div>
<div id="footer">
(c) <?php echo date("Y"); ?> Nicholas Andre. design by <a href="http://www.freecsstemplates.org/">fct</a>.
<br />
<a href="https://github.com/WMFO/Training-Website">code</a> freely licensed under the <a href="http://www.gnu.org/copyleft/gpl.html">gpl</a>
</div>
</body>
</html>
