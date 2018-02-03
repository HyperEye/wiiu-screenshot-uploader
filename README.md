# wiiu-screenshot-uploader
Wii U Screenshot Uploader Web Application

Host this application on your own web server and upload screenshots directly
from your Wii U.

 -- Requirements --
 ==================

 * PHP
 * PHP ImageMagick Library

 -- Configuration --
 ===================

This application should be hosted on a web server and made accessible to your
Wii U either on a LAN or at a remote address. This application allows a user to
upload files to your server or drive. You should consider whether or not you
are comfortable with anonymous users uploading files before you make the
application publicly accessible. I recommend that you host this application
using https and that you protect access to it with credentials. The application
does attempt to verify that the file is a valid image but it is your
responsibility to secure your server with a rational configuration. Your
server should not execute any code contained in a file that identifies with an
image mime type and file extension.

There are a few options that can be modified in config.php including the upload
path. It is documented. Please read and modify it as needed.

 -- Usage --
 ===========

While playing a game push the Home button on your gamepad or controller. Open
the internet browser. Navigate to the address at which the scripts are available
(I recommend that you bookmark it.)

The only required field is the top image. Select browse and pick either the TV
or gamepad.  Optionally a bottom image can be selected and it will be appended
to the top image. This allows you to grab the TV and gamepad in one screenshot.
The screenshot can be categorized into a game folder by selecting a game from
the selection pull-down. If the game is not listed (no games are listed by
default) the game can be entered into the "Other" field.  That game will be
available in the pull-down on subsequent use. The "Rename" field is used to
assign an explicit name to the screenshot. Do not include the file extension.
It is often necessary that the "Rename" field be used due to screenshots from
some games having a common name. The application will not overwrite an existing
screenshot.

Some games do not allow you to take a screenshot. If you attempt to take a
screenshot while playing one of these games you will see a message indicating
that there are no available files to select.
