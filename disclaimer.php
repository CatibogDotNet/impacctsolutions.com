<?php include ("includes/header.php"); ?>
	<div id="menublock">
		<div id="menu" >
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="aboutus.php">About Us</a></li>
				<li><a href="contactus.php">Contact Us</a></li>
				<li><a href="software.php">Software</a></li>
				<li><a href="disclaimer.php">Downloads</a></li>
			</ul>
		</div>
	</div>
		
	<div class="clear"></div>
	<hr />
	<div id="title">Downloads</div><br /><br />
	<hr />
	<p> Simple excel payroll calculator is ready for testing.  By downloading <a href="SimpleOntPayrollCalc2015.xlsm"> this, </a> 
		you attest that you have read and agree with disclaimer below and that "this" is called "software".    
	&nbsp &nbsp Please note that this is for ONTARIO and year 2015 only.  Please, please send us feedback so we can correct bugs.</p>
	<p> Instructions for use: </p>
	<ol>
		<li> Click on "Exit Macro" (you can re-run the macro by pressing ctrl-A)</li>
		<li> Enter your company information in sheet called "Company"</li>
		<li> Enter your employee information in sheet called "EmpData" (you will need each employee's completed TD1 form, name, 
			address, and benefits, if any.) &nbsp &nbsp Please delete the "dummy" employees listed as they do not pertain 
			to your company.</li>
		<li> Save the file as "SimpleOntPayrollCalc2015.xlsm"</li>	
		<li> Press ctrl-A to run the payroll data entry macro.</li>
		<li> The required data are the paydate, and employee number.  All others are optional except for benefits.  No entry 
			is required for benefits.</li>
		<li> Always click on "Validate" before clicking on "Calculate and Record Pay"</li>
		<li> Each time "Calculate and Record Pay" is clicked, an entry is made on sheet called "PayrollData"</li>
		<li> "PayrollData" contains data that could be used to fill the T4 and related reports.  Lines could be manually added, edited or 
			deleted from this sheet should the need arise (possibly from bugs).  (Just make sure you exit the macro first.)  You may be able to cut and 
			paste these data to future versions of this excel spreadsheet.</li>
		<li>  I hope you find this tool useful and give us feedback so we can improve it.  We are continually updating this file as we 
			correct found bugs.</li>
		
	</ol>
	<p>Thank you!!!</p>
	
	<h1>Disclaimer</h1>
	<hr />
	
	<div>
		<p> ALL SOFTWARE IN THIS WEBSITE SHALL BE CALLED THE "SOFTWARE".  
		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESSED OR
		IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
		FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
		AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
		LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
		OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
		THE SOFTWARE.
		</p>
	</div>
<?php include ("includes/footer.php"); ?>