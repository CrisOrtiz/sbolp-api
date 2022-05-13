<?php

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
  /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $comment = new Comment();
        $comment->user_id = '1';
        $comment->clinic_case_id = '1';
        $comment->content = 'Que buen aporte, me gustaria saber si este proceso es recomendable con dientes de leche.';
        $comment->owner = 'Dr. Admin0 AdminLastname';
        $comment->isRead = false;
        $comment->save();

        $comment = new Comment();
        $comment->user_id = '2';
        $comment->clinic_case_id = '1';
        $comment->content = 'Se me presento un caso similar, aplicaré este procedimiento, gracias!';
        $comment->owner = 'Dr. Admin1 AdminLastname';
        $comment->isRead = true;
        $comment->save();
    }
}
