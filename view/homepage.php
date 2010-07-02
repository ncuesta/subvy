<html>
  <head>
    <title>{ $title }</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="title" content="{ $title }" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
  </head>
  <body>
    <h1>{ $title }</h1>

    <div id="content">
      <form id="creation_form" action="?action=submit" method="post">
        <div class="form_body">
          { $subversion_root_url }/<input type="text" name="name" id="repo_name" value="repo" />
        </div>

        <div class="actions">
          <input id="do-submit" type="submit" value="Crear repositorio" />
          <span id="response"></span>
        </div>
      </form>
    </div>

    <script type="text/javascript">
    //<![CDATA[
    jQuery('#repo_name').focus().keyup(function () {
      jQuery.get('?action=check', { n: function () { return jQuery('#repo_name').val(); } }, function (data) {
        jQuery('#response').html(data);
      });
    });

    jQuery('#do-submit').attr('disabled', 'disabled');
    //]]>
    </script>
    <div id="c"><a href="mailto:ncuesta@cespi.unlp.edu.ar">ncuesta</a></div>
  </body>
</html>
