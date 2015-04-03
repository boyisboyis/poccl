<div id="admin-add-user" class='t3'>
  <div id='admin-add-user-block'>
    <div id="front-message" class="front-msg">Username : </div>
    <input type="username" id="input-username" name="input-username" /><br>
    <div id="front-message" class="front-msg">Password : </div>
    <input type="password" id="input-password" name="input-password" /><br>
    <div id="front-message" class="front-msg">Confirm Password : </div>
    <input type="password" id="input-confirm" name="input-confirm" /><br>
    <div id="front-message" class="front-msg">Authentication : </div>
    <select id="select-auth">
      <option value="2">Viewer</option>
      <option value="1">Author</option>
      <option value="0">Administator</option>
    </select>
    <button id="add-user">ADD USER</button>
  </div>
  <div id="admin-add-user-box-alert" style="display: none;">
		<section>
			<h3 id="msg-alert"></h3>
			<div id="add-user-confirm">
				<button id="add-user-confirm-yes">Yes</button>
				<button id="add-user-confirm-no">NO</button>
			</div>
			<div id="add-user-msg-alert" style="display: none;">
				<button id="add-user-msg-button">Close</button>
			</div>
		</section>
	</div>
</div>