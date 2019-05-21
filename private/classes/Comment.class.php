<?php

class Comment extends User {

static protected $table_name = 'comments_wine';
static protected $db_columns = ['id', 'users_userid', 'wines_wineid', 'comment'];

public $id;
public $users_userid;
public $wines_wineid;
public $comment;



public function __construct($args=[])
{
    $this->users_userid = $args['users_userid'] ?? '';
    $this->wines_wineid = $args['wines_wineid'] ?? '';
    $this->comment = $args['comment'] ?? '';
}



public function get_comment($wineid) {
    $sql = ('SELECT username, comment FROM users, comments_wine WHERE wines_wineid = "'. $wineid . '" AND users.id = comments_wine.users_userid ORDER BY comments_wine.id ASC');
    $comment = Comment::find_by_sql($sql);
    foreach($comment as $comments) { ?>
      
        <div class="comment">
        <p><span class="username"><?= $comments->username ?>:</span> <?= $comments->comment ?></p>
        </div>
      
      <?php };
}


};
