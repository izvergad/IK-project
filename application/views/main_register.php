<div id="register">
    	<img class="bild1" src="/design/bild1.jpg" width="173" height="85" />
        <img class="bild2" src="/design/bild2.jpg" width="173" height="85" />
        <h1>����� ���������� � ��� �������</h1>
        <p class="desc">��� ������ ���� ���������� ������ ���, ������ � ����� e-mail � ������� �������� ���������.</p>
        <form name="registerForm" action="#" method="post">
            <input type="hidden" name="function" value="createAvatar">
            <p class="desc">
    	        <table cellpadding="3" cellspacing="0" id="logindata">
                    <tr>
                        <td><label for="welt" class="labelwelt">���</label></td>
                    	<td>
                            <select id="universe" class="uni" size="1" onchange="getServerNotice(this.value, 'infotext');">
                                <option value="alpha" >Alpha</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="login" class="labellogin">��� ������</label></td>
                        <td><input type='text' name='name' class="startinput"  size='30'></td>
                    </tr>
                    <tr>
                        <td><label for="login" class="labellogin">������</label></td>
                        <td><input type='password' name='password' class="startinput" size='30'></td>
                    </tr>
                    <tr>
                        <td><label for="login" class="labellogin">e-mail</label></td>
                        <td><input type='text' name='email' class="startinput" size='30'></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type=checkbox name="agb" >� �������� �������� ���������.</td>
                    </tr>
                </table>
            </p>
            <div id="infotext"></div>
            <input type="submit" class="button" value="�����������">
        </form>
</div>