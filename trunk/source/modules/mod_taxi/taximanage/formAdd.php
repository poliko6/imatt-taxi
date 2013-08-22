<?
$major_data = select_db('majoradmin',"where garageId = '".$garageid."'");
$major_name = $major_data[0]['thaiCompanyName'];
?>

<!-- form functions -->
<script src="js/gebo_forms.js"></script>

    

<div class="row-fluid">
    <div class="span12">
        <h3 class="heading" style="font-size:12px; text-align:center;">เพิ่มรถแท๊กซี่ในระบบ ของอู่ "<span style="color:#06C;"><?=$major_name?></span>"</h3>
        <div class="row-fluid">
            <div class="span8">
                <form class="form-horizontal">
                    <fieldset>
                        <div class="control-group formSep">
                            <label class="control-label">ทะเบียนรถ</label>
                            <div class="controls text_line">
                                <input type="text" name="carRegistration" id="carRegistration" class="input-xlarge" value="<?=$carRegistration?>" />
                            </div>
                        </div>
                        <div class="control-group formSep">
                            <label for="fileinput" class="control-label">User avatar</label>
                            <div class="controls">
                                <div data-provides="fileupload" class="fileupload fileupload-new">
                                    <input type="hidden" />
                                    <div style="width: 80px; height: 80px;" class="fileupload-new thumbnail"><img src="http://www.placehold.it/80x80/EFEFEF/AAAAAA" alt="" /></div>
                                    <div style="width: 80px; height: 80px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" id="fileinput" name="fileinput" /></span>
                                    <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
                                </div>	
                            </div>
                        </div>
                        
                        <div class="formSep">
                            <p class="sepH_c"><span class="label label-inverse">Password strength checker</span></p>
                            <div class="row-fluid">
                                <div class="span4">
                                    <input type="password" placeholder="Password, min. 6 chars" class="span8" id="pass_check" />
                                    <div id="pass_progress" class="progress progress-danger" style="width:60%">
                                        <div class="bar" style="width: 0"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="control-group formSep">
                            <label for="u_fname" class="control-label">Full name</label>
                            <div class="controls">
                                <input type="text" id="u_fname" class="input-xlarge" value="John Smith" />
                            </div>                           	
                        </div>
                        <div class="control-group formSep">
                            <label for="u_email" class="control-label">Email</label>
                            <div class="controls">
                                <input type="text" id="u_email" class="input-xlarge" value="johnSmith@example.com" />
                            </div>
                        </div>
                        <div class="control-group formSep">
                            <label for="u_password" class="control-label">Password</label>
                            <div class="controls">
                                <div class="sepH_b">
                                    <input type="password" id="u_password" class="input-xlarge" value="my_password" />
                                    <span class="help-block">Enter your password</span>
                                </div>
                                <input type="password" id="s_password_re" class="input-xlarge" />
                                <span class="help-block">Repeat password</span>
                            </div>
                        </div>
                        <div class="control-group formSep">
                            <label class="control-label">I want to receive:</label>
                            <div class="controls">
                                <label class="checkbox inline">
                                    <input type="checkbox" value="newsletter" id="email_newsletter" name="email_receive" />
                                    Newsletters
                                </label>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="sys_messages" id="email_sysmessages" name="email_receive" checked="checked" />
                                    System messages
                                </label>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="other_messages" id="email_othermessages" name="email_receive" />
                                    Other messages
                                </label>
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
                                    Male
                                </label>
                                <label class="radio inline">
                                    <input type="radio" value="female" id="s_female" name="f_gender" />
                                    Female
                                </label>
                            </div>
                        </div>
                        <div class="control-group formSep">
                            <label for="u_signature" class="control-label">Signature</label>
                            <div class="controls">
                                <textarea rows="4" id="u_signature" class="input-xlarge">Lorem ipsum&hellip;</textarea>
                                <span class="help-block">Automatic resize</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button class="btn btn-gebo" type="submit">Save changes</button>
                            	<input type="button" class="btn" onClick="reloadPage()" value="Cancel">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>