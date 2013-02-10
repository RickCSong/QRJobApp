'use strict';

define(
  function() {
    var mailItem =
      '{{#mailItems}}\
        <tr id="{{id}}" class="mail-item">\
        {{#important}}\
          <td class="span1"><span class="label label-important">Important</span></td>\
        {{/important}}\
        {{^important}}\
          <td class="span1"><span>&nbsp;</span></td>\
        {{/important}}\
          <td class="span2 mailContact">{{name}}</td>\
          <td class="span8">\
            <span class="mailSubject">\
              {{jobName}}\
            </span>\
            <span class="mailMessage">\
              - <a href="#{{id}}-collapse" data-toggle="collapse">Read More</a>\
            </span>\
            <div id="{{id}}-collapse" class="collapse applicant-detail">\
              <b>Phone Number:</b> {{phone}}<br>\
              <b>E-mail:</b> {{email}}<br>\
              <b>School:</b> {{school}}<br>\
              <a href="/files/{{contactId}}_resume.pdf" class="btn btn-small btn-primary" type="button" style="margin: 5px 0px 5px 0px;">View Resume</a>\
            </div>\
          </td>\
        </tr>\
      {{/mailItems}}';

    var composeBox =
      '<div id="compose_to" class="modal-header compose-header">\
        To: <select id="recipient_select">\
          {{^reply}}<option id="recipient_hint" class="hint" style="color:#CACACA" >[Select Recipient]</option>{{/reply}}\
          {{#contacts}}\
           <option id="{{id}}"{{#recipient}} selected{{/recipient}}>{{firstName}} {{lastName}}</option>\
          {{/contacts}}\
        </select>\
      </div>\
      <div class="modal-body compose-body">\
        <div id="compose_subject" class="{{#newMail}}hint{{/newMail}}{{^newMail}}compose-header{{/newMail}}" contentEditable="true">\
          {{subject}}\
        </div>\
        <div id="compose_message" class="hint" contentEditable="true">\
          {{message}}\
        </div>\
      </div>\
      <div class="modal-footer">\
        <button id="send_composed" {{^reply}}disabled="disabled"{{/reply}} class="btn btn-primary">Send</button>\
        <button id="cancel_composed" class="btn">Cancel</button>\
      </div>';

    var moveToSelector =
      '<ul class="nav nav-list">\
      {{#moveToItems}}\
        <li id="{{.}}" class="move-to-item">{{.}}</li>\
      {{/moveToItems}}\
      </ul>';

    var jobItem = 
      '{{#jobItems}}\
      <li class="job-item {{selected}}" id="{{id}}"><i class="icon-wrench"></i>{{title}}</li>\
      {{/jobItems}}';

    var jobDescription = 
      '<img src="/img/Companies/{{company}}_logo.png" style="margin-bottom: 15px">\
      <div class="job-title">{{title}}</div>\
      <div class="job-source">{{location}}</div>\
      <div> \
        <div class="job-greytext" style="display: inline-block;">Software Engineering</div>\
        <div style="display: inline-block;">·</div>\
        <div class="job-greytext" style="display: inline-block;">{{duration}}</div>\
      </div>\
      <div class="job-content">\
        <div class="job-heading">Job Description</div>\
        <p style="margin-left: 10px">\
          Do you want to help Google build next-generation web applications like Gmail, Google Docs, Google Maps, and Google+?  As a Front End Engineer at Google, you will specialize in building responsive and elegant web UIs with AJAX and similar technologies.\
        </p>\
      </div>\
      <div class="row-fluid">\
        <div class="span6">\
          <div class="job-heading">Minimum Qualifications</div>\
          <div class="detail-content offset">\
            <ul>\
              <li class="job-detail-item">BS degree in Computer Science or related field (In lieu of degree, 4 years of relevant work experience). </li>\
              <li class="job-detail-item">Development experience in server-side technologies such as C/C++ and/or Java.</li>\
              <li class="job-detail-item">Experience with AJAX, HTML and CSS, or Ruby, with an interest in user  \
              interface design.</li>\
              <li class="job-detail-item">Web application development experience.</li>\
            </ul>\
          </div>\
        </div>\
        <div class="span6">\
          <div class="job-heading">Preferred Qualifications</div>\
          <div class="detail-content offset">\
            <ul>\
              <li class="job-detail-item">Masters or PhD in Computer Science or related field.</li>\
              <li class="job-detail-item">Significant experience developing user-facing software.</li>\
              <li class="job-detail-item">Experience working on cross-browser platforms.</li>\
              <li class="job-detail-item">Knowledge of UI frameworks such as XUL, Flex, and XAML.</li>\
              <li class="job-detail-item">Object-oriented JavaScript skills.</li>\
            </ul>\
          </div>\
        </div>\
      </div>\
      <div class="detail-item">\
        <div class="job-heading">Area</div>\
        <div class="detail-content offset">\
          <p style="margin-left: 10px">\
            Google is and always will be an engineering company. We hire people with a broad set of technical skills who are ready to tackle some of technologys greatest challenges and make an impact on millions, if not billions, of users. At Google, engineers not only revolutionize search, they routinely work on massive scalability and storage solutions, large-scale applications and entirely new platforms for developers around the world. From AdWords to Chrome, Android to YouTube, Social to Local, Google engineers are changing the world one technological achievement after another.\
          </p>\
        </div>\
      </div>\
      <div class="job-apply"> \
        <div class="job-heading">Apply Now</div>\
        <div id="qrcode"></div>\
      </div>';

    return {
      mailItem: mailItem,
      composeBox: composeBox,
      moveToSelector: moveToSelector,
      jobItem: jobItem,
      jobDescription: jobDescription
    }
  }

);
