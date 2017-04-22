<p>
Disclaimer: <br />

The information and software contained in this website are for general information or <br />testing purposes only.<br /> <br />
The information and software are provided by IMPACCT Solutions and while we endeavour <br />
to keep the information and software up to date and correct, we make no representations <br />
or warranties of any kind, express or implied, about the completeness, accuracy, <br />
reliability, suitability or availability with respect to the website or the information,<br />
software, products, services, or related graphics contained on the website for any <br />
purpose. Any reliance you place on such information is therefore strictly at your own <br />
risk. <br /><br />
In no event will we be liable for any loss or damage including without limitation, <br />
indirect or consequential loss or damage, or any loss or damage whatsoever arising <br />
from loss of data or profits arising out of, or in connection with, the use of this <br />
website. <br /><br />
Through this website you are able to link to other websites which are not under the <br />
control of IMPACCT Solutions.  We have no control over the nature, content and <br />
availability of those sites. The inclusion of any links does not necessarily imply <br />
a recommendation or endorse the views expressed within them. Every effort is made <br />
to keep the website up and running smoothly. However, IMPACCT Solutions takes no <br />
responsibility for, and will not be liable for, the website being temporarily <br />
unavailable due to technical issues beyond our control. 
</p>
<?php 

echo form_open('accounting/disclaimer_read');
// two submit buttons
echo form_submit('submit', 'I have read the disclaimer');
echo form_submit('submit', 'Cancel');
echo form_close();

?>