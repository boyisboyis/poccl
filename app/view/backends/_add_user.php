<div id="admin-add-user" class='t3'>
  <section id='admin-add-user-block'>
    <h2>Add New User</h2>
    <div>
      <input type="username" id="input-username" name="input-username" placeholder="Username" />
    </div>
    <div>
      <input type="password" id="input-password" name="input-password" placeholder="Password" />
    </div>
    <div> 
      <input type="password" id="input-confirm" name="input-confirm" placeholder="Confirm Password" />
    </div>
    <h3 id="front-message" class="front-msg">Authentication</h3>
    <select id="select-auth">
      <option value="2">Viewer</option>
      <option value="1">Author</option>
      <option value="0">Administator</option>
    </select>
    <div>
      <button id="add-user">ADD USER</button>
    </div>
  </section>
  <div id="admin-add-user-box-alert" style="display: none;">
		<section style="height: 250px; margin-top: -125px;">
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