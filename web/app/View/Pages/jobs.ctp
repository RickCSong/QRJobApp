<?php $this->assign('title', "QRapp.ly - Jobs"); ?>

<?php  $this->start('css'); ?>
  <!-- Supply additional CSS here -->
  <link rel="stylesheet" href="/css/app/jobs.css">
<?php $this->end('css'); ?>

<br>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2">
      <div class="sidebar-nav">

        <button id="new_job" class="btn compose">New Job</button>

        <br><br>

        <ul id="folders" class="nav nav-list">
          <li class="job-item selected" id="inbox"><i class="icon-wrench"></i>Software Engineer</li>
          <li class="job-item" id="later"><i class="icon-wrench"></i>Web Developer</li>
          <li class="job-item" id="later"><i class="icon-shopping-cart"></i>Marketing Manager</li>
        </ul>
      </div>
    </div>

    <div id="mail_panel" class="span10">
    	<img src="https://www.google.com/images/logos/google_logo_41.png" style="margin-bottom: 15px">
		<div class="job-title">Front End Software Engineer</div>
		<div class="job-source">Mountain View, CA, USA</div>
		<div> 
			<div class="job-greytext" style="display: inline-block;">Software Engineering</div>
			<div style="display: inline-block;">·</div>
			<div class="job-greytext" style="display: inline-block;">Full-time</div>
		</div>

		<div class="job-content">
			<div class="job-heading">Job Description</div>
			<p style="margin-left: 10px">
				Do you want to help Google build next-generation web applications like Gmail, Google Docs, Google Maps, and Google+?  As a Front End Engineer at Google, you will specialize in building responsive and elegant web UIs with AJAX and similar technologies.
			</p>
		</div>
		
		<div class="row-fluid">
			<div class="span6">
				<div class="job-heading">Minimum Qualifications</div>
				<div class="detail-content offset">
					<ul>
						<li class="job-detail-item">BS degree in Computer Science or related field (In lieu of degree, 4 years of relevant work experience). </li>
						<li class="job-detail-item">Development experience in server-side technologies such as C/C++ and/or Java.</li>
						<li class="job-detail-item">Experience with AJAX, HTML and CSS, or Ruby, with an interest in user  
						interface design.</li>
						<li class="job-detail-item">Web application development experience.</li>
					</ul>
				</div>
			</div>
			<div class="span6">
				<div class="job-heading">Preferred Qualifications</div>
				<div class="detail-content offset">
					<ul>
						<li class="job-detail-item">Masters or PhD in Computer Science or related field.</li>
						<li class="job-detail-item">Significant experience developing user-facing software.</li>
						<li class="job-detail-item">Experience working on cross-browser platforms.</li>
						<li class="job-detail-item">Knowledge of UI frameworks such as XUL, Flex, and XAML.</li>
						<li class="job-detail-item">Object-oriented JavaScript skills.</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="detail-item">
			<div class="job-heading">Area</div>
			<div class="detail-content offset">
				<p style="margin-left: 10px">
					Google is and always will be an engineering company. We hire people with a broad set of technical skills who are ready to tackle some of technology's greatest challenges and make an impact on millions, if not billions, of users. At Google, engineers not only revolutionize search, they routinely work on massive scalability and storage solutions, large-scale applications and entirely new platforms for developers around the world. From AdWords to Chrome, Android to YouTube, Social to Local, Google engineers are changing the world one technological achievement after another.
				</p>
			</div>
		</div>
		
		<div class="job-apply"> 
			<div class="job-heading">Apply Now</div>
			<a href="#qrModal" id="qrcode" data-toggle="modal"></a>
		</div>

		<div id="qrModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			
			<div class="modal-body">
				<div id="qrcodeLarge">
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div>
    </div>
  </div>
</div>

<?php $this->start('script'); ?>

<script type="text/javascript" src="/js/lib/jquery.qrcode.min.js"></script>

<script type="text/javascript">
	$('#qrcode').qrcode({
		width: 80,
		height: 80,
		text	: "http://qrapply-rickcsong.dotcloud.com/apply"
	});	

	$('#qrcodeLarge').qrcode({
		width: 300,
		height: 300,
		text	: "http://qrapply-rickcsong.dotcloud.com/apply"
	});	
</script>


<?php $this->end('script'); ?>
