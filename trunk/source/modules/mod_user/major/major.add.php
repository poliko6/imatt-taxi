
<div class="row-fluid">
  <div class="span12">
    <h3 class="heading">เพิ่มข้อมูล</h3>
    <div class="row-fluid">
      <div class="span8">
        <form class="form-horizontal">
          <fieldset>
            <div class="control-group formSep">
              <label class="control-label">Username</label>
              <div class="controls text_line"> <strong>jSmith</strong> </div>
            </div>
            
            <div class="control-group formSep">
              <label for="fileinput" class="control-label">User avatar</label>
              <div class="controls">
                <div data-provides="fileupload" class="fileupload fileupload-new">
                  <input type="hidden" />
                  <div style="width: 80px; height: 80px;" class="fileupload-new thumbnail"><img src="http://www.placehold.it/80x80/EFEFEF/AAAAAA" alt="" /></div>
                  <div style="width: 80px; height: 80px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                  <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                  <input type="file" id="fileinput" name="fileinput" />
                  </span> <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a> </div>
              </div>
            </div>
            
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">ชื่อบริษัทภาษาไทย :</label>
              <div class="controls">
                <input type="text" id="u_fname" class="input-xlarge" value="" />
              </div><br />
              <label for="u_fname" class="control-label">ชื่อบริษัทภาษาอังกฤษ :</label>
              <div class="controls">
                <input type="text" id="u_fname" class="input-xlarge" value="" />
              </div><br />
              <label for="u_fname" class="control-label">ชื่อผู้บริหาร :</label>
              <div class="controls">
                <input type="text" id="u_fname" class="input-xlarge" value="" />
              </div>                            
            </div>
            
            <div class="control-group formSep">
              <label for="u_fname" class="control-label">Username</label>
              <div class="controls">
                <input type="text" id="u_fname" class="input-xlarge" value="" />
              </div><br />            
              <label for="u_password" class="control-label">Password</label>
              <div class="controls">
                <div class="sepH_b">
                  <input type="password" id="u_password" class="input-xlarge" value="" /><span class="help-block">กรุณาใส่พาสเวิร์ด</span> </div>
                <input type="password" id="s_password_re" class="input-xlarge" /><span class="help-block">พิมพ์พาสเวิร์ดเดิมอีกครั้ง</span> 
                </div>
            </div>            
            
            <div class="control-group formSep">
              <label for="u_email" class="control-label">Email</label>
              <div class="controls">
                <input type="text" id="u_email" class="input-xlarge" value="" />
              </div>
            </div>            
            
            <div class="control-group formSep">
              <label class="control-label">I want to receive:</label>
              <div class="controls">
                <label class="checkbox inline">
                  <input type="checkbox" value="newsletter" id="email_newsletter" name="email_receive" />
                  Newsletters </label>
                <label class="checkbox inline">
                  <input type="checkbox" value="sys_messages" id="email_sysmessages" name="email_receive" checked="checked" />
                  System messages </label>
                <label class="checkbox inline">
                  <input type="checkbox" value="other_messages" id="email_othermessages" name="email_receive" />
                  Other messages </label>
              </div>
            </div>
            <div class="control-group formSep">
              <label class="control-label">Language(s)</label>
              <div class="controls">
                <select name="user_languages" id="user_languages" multiple data-placeholder="Choose a language(s)..." class="span8">
                  <option selected="selected">English</option>
                  <option>French</option>
                  <option>German</option>
                  <option>Italian</option>
                  <option>Chinese</option>
                  <option>Spanish</option>
                </select>
              </div>
            </div>
            <div class="control-group formSep">
              <label class="control-label">Gender</label>
              <div class="controls">
                <label class="radio inline">
                  <input type="radio" value="male" id="s_male" name="f_gender" checked="checked" />
                  Male </label>
                <label class="radio inline">
                  <input type="radio" value="female" id="s_female" name="f_gender" />
                  Female </label>
              </div>
            </div>
            <div class="control-group formSep">
              <label for="u_signature" class="control-label">Signature</label>
              <div class="controls">
                <textarea rows="4" id="u_signature" class="input-xlarge">Lorem ipsum&hellip;</textarea>
                <span class="help-block">Automatic resize</span> </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button class="btn btn-gebo" type="submit">บันทึกการเพิ่มข้อมูล</button>
                <a href="index.php?p=user.major&menu=main_user"><button class="btn">ยกเลิก</button></a>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
