
<h3>This is message content</h3>
<p><?php echo $this->lang->line('welcome_message'); ?></p>
<p><?php echo nl2br("<div class='email-body'>
Dear {{name}},

Your idea has been received and registered in our system. You will be duly notified about the status of your idea within 10 working days.

<table>
 <tbody>
  <tr>
   <th>Reference number:</th><td>{{number}}</td>
  </tr>
  <tr>
   <th>Title:</th><td>{{title}}</td>
  </tr>
  <tr>
   <th>Details:</th><td>{{submissionDescription}}</td>
  </tr>
  <tr>
   <th>Category:</th><td>{{categoryName}}</td>
  </tr>
  <tr>
   <th>Status:</th><td>{{underReview}}</td>
  </tr>
 </tbody>
</table>
</div>
<div class='email-footer'>
Thank you for your submission. For further updates, please visit your profile on <a href='http://www.mbrmajlis.ae/'>http://www.mbrmajlis.ae/</a>

<span>* This is a system generated email; please do not reply to it.</span>

Mohammed Bin Rashid Smart Majlis
</div>"); ?></p>
