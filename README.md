Mpbot Debugger
==============

##Purpose
This program is simple realtime logger by HTML5 server-sent event and HTTP redirector between developer's local and callback server for Mypeople Bot API. You can debug HTTP request/responses and implement early features using developer's PC inner intranet.

Please use Firefox, Chrome, Safari not Internet Explorer.

##Install
* Server script: callback.php
* Client script: You can use this HTML code direct and only edit event source location.
"`
    var source=new EventSource("callback.php");
"`
* If log file sizes up 4k, logs are deleted automatically. 

##How to Test

1. Download and install Mypeople PC version.
2. In tab of 'Add friends', input 'channy.bot' with 'Find by ID'.
3. You can see addBuddy log when a friend is added.
4. You can see sendFromMessage when a message is sent.
5. Real response is done by action.php of developer's PC and its code is based on Bot API sample code of Daum DNA's github.
 
## Demo
* Korean: http://channy.creation.net/project/mypeople/
* English: http://channy.creation.net/project/mypeople/index_en.html 


