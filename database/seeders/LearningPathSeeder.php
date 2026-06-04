<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\SubChapter;
use App\Models\Level;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningPathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear old data to prevent duplication issues
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        QuestionOption::truncate();
        Question::truncate();
        Level::truncate();
        SubChapter::truncate();
        Chapter::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ── CHAPTER 1 ─────────────────────────────────────────────
        $chapter1 = Chapter::create([
            'title' => 'Salam Dasar',
            'description' => 'Mulai perjalananmu dengan Hanacaraka',
            'order_index' => 1,
        ]);

        $subChapter1 = SubChapter::create([
            'chapter_id' => $chapter1->id,
            'title' => 'Hanacaraka & Salam',
            'order_index' => 1,
        ]);

        // Level 1: Sugeng Enjang
        $level1 = Level::create([
            'sub_chapter_id' => $subChapter1->id,
            'title' => 'Mulai: Sugeng Enjang',
            'order_index' => 1,
            'xp_reward' => 10,
        ]);

        $q1_1 = Question::create([
            'level_id' => $level1->id,
            'instruction' => 'Ubah kata pada soal menjadi Basa Ngoko atau Bahasa Indonesia',
            'question_text' => 'Sugeng Enjing',
            'question_type' => 'multiple_choice',
        ]);
        QuestionOption::create(['question_id' => $q1_1->id, 'option_text' => 'Selamat Pagi', 'is_correct' => true]);
        QuestionOption::create(['question_id' => $q1_1->id, 'option_text' => 'Selamat Siang', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q1_1->id, 'option_text' => 'Selamat Sore', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q1_1->id, 'option_text' => 'Selamat Malam', 'is_correct' => false]);

        $q1_2 = Question::create([
            'level_id' => $level1->id,
            'instruction' => 'Pilih Aksara Jawa yang tepat untuk transliterasi Latin di bawah ini',
            'question_text' => 'Ha',
            'question_type' => 'multiple_choice',
        ]);
        QuestionOption::create(['question_id' => $q1_2->id, 'option_text' => 'ꦲ', 'is_correct' => true]);
        QuestionOption::create(['question_id' => $q1_2->id, 'option_text' => 'ꦤ', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q1_2->id, 'option_text' => 'ꦕ', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q1_2->id, 'option_text' => 'ꦫ', 'is_correct' => false]);

        $q1_3 = Question::create([
            'level_id' => $level1->id,
            'instruction' => 'Ubah kata pada soal menjadi Basa Ngoko atau Bahasa Indonesia',
            'question_text' => 'Sugeng Siang',
            'question_type' => 'multiple_choice',
        ]);
        QuestionOption::create(['question_id' => $q1_3->id, 'option_text' => 'Selamat Siang', 'is_correct' => true]);
        QuestionOption::create(['question_id' => $q1_3->id, 'option_text' => 'Selamat Sore', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q1_3->id, 'option_text' => 'Selamat Pagi', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q1_3->id, 'option_text' => 'Selamat Malam', 'is_correct' => false]);

        // Level 2: Kosakata Dasar
        $level2 = Level::create([
            'sub_chapter_id' => $subChapter1->id,
            'title' => 'Kosakata Dasar',
            'order_index' => 2,
            'xp_reward' => 15,
        ]);

        $q2_1 = Question::create([
            'level_id' => $level2->id,
            'instruction' => 'Ubah kata pada soal menjadi Basa Ngoko atau Bahasa Indonesia',
            'question_text' => 'Makan',
            'question_type' => 'multiple_choice',
        ]);
        QuestionOption::create(['question_id' => $q2_1->id, 'option_text' => 'Mangan', 'is_correct' => true]);
        QuestionOption::create(['question_id' => $q2_1->id, 'option_text' => 'Turu', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q2_1->id, 'option_text' => 'Lunga', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q2_1->id, 'option_text' => 'Ngombe', 'is_correct' => false]);

        $q2_2 = Question::create([
            'level_id' => $level2->id,
            'instruction' => 'Ubah kata pada soal menjadi Basa Ngoko atau Bahasa Indonesia',
            'question_text' => 'Turu',
            'question_type' => 'multiple_choice',
        ]);
        QuestionOption::create(['question_id' => $q2_2->id, 'option_text' => 'Tidur', 'is_correct' => true]);
        QuestionOption::create(['question_id' => $q2_2->id, 'option_text' => 'Makan', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q2_2->id, 'option_text' => 'Pergi', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q2_2->id, 'option_text' => 'Minum', 'is_correct' => false]);

        $q2_3 = Question::create([
            'level_id' => $level2->id,
            'instruction' => 'Ubah kata pada soal menjadi Basa Ngoko atau Bahasa Indonesia',
            'question_text' => 'Minum',
            'question_type' => 'multiple_choice',
        ]);
        QuestionOption::create(['question_id' => $q2_3->id, 'option_text' => 'Ngombe', 'is_correct' => true]);
        QuestionOption::create(['question_id' => $q2_3->id, 'option_text' => 'Mangan', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q2_3->id, 'option_text' => 'Turu', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q2_3->id, 'option_text' => 'Lunga', 'is_correct' => false]);

        // Level 3: Krama Alus
        $level3 = Level::create([
            'sub_chapter_id' => $subChapter1->id,
            'title' => 'Krama Alus',
            'order_index' => 3,
            'xp_reward' => 20,
        ]);

        $q3_1 = Question::create([
            'level_id' => $level3->id,
            'instruction' => 'Ubah kata pada soal menjadi Basa Ngoko atau Bahasa Indonesia',
            'question_text' => 'Makan (Sopan)',
            'question_type' => 'multiple_choice',
        ]);
        QuestionOption::create(['question_id' => $q3_1->id, 'option_text' => 'Dahar', 'is_correct' => true]);
        QuestionOption::create(['question_id' => $q3_1->id, 'option_text' => 'Mangan', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q3_1->id, 'option_text' => 'Nedha', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q3_1->id, 'option_text' => 'Turu', 'is_correct' => false]);

        $q3_2 = Question::create([
            'level_id' => $level3->id,
            'instruction' => 'Ubah kata pada soal menjadi Basa Ngoko atau Bahasa Indonesia',
            'question_text' => 'Kula',
            'question_type' => 'multiple_choice',
        ]);
        QuestionOption::create(['question_id' => $q3_2->id, 'option_text' => 'Saya', 'is_correct' => true]);
        QuestionOption::create(['question_id' => $q3_2->id, 'option_text' => 'Kamu', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q3_2->id, 'option_text' => 'Mereka', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q3_2->id, 'option_text' => 'Kita', 'is_correct' => false]);

        $q3_3 = Question::create([
            'level_id' => $level3->id,
            'instruction' => 'Ubah kata pada soal menjadi Basa Ngoko atau Bahasa Indonesia',
            'question_text' => 'Tidur (Sopan)',
            'question_type' => 'multiple_choice',
        ]);
        QuestionOption::create(['question_id' => $q3_3->id, 'option_text' => 'Sare', 'is_correct' => true]);
        QuestionOption::create(['question_id' => $q3_3->id, 'option_text' => 'Turu', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q3_3->id, 'option_text' => 'Nedha', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q3_3->id, 'option_text' => 'Dahar', 'is_correct' => false]);

        // Level 4: Cerita Jawa
        $level4 = Level::create([
            'sub_chapter_id' => $subChapter1->id,
            'title' => 'Cerita Jawa',
            'order_index' => 4,
            'xp_reward' => 25,
        ]);

        $q4_1 = Question::create([
            'level_id' => $level4->id,
            'instruction' => 'Ubah kata pada soal menjadi Basa Ngoko atau Bahasa Indonesia',
            'question_text' => 'Jenis paragraf mawa urutan kadadeyan ing crita yaiku...',
            'question_type' => 'multiple_choice',
        ]);
        QuestionOption::create(['question_id' => $q4_1->id, 'option_text' => 'Narasi', 'is_correct' => true]);
        QuestionOption::create(['question_id' => $q4_1->id, 'option_text' => 'Deskripsi', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q4_1->id, 'option_text' => 'Eksposisi', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q4_1->id, 'option_text' => 'Persuasi', 'is_correct' => false]);

        $q4_2 = Question::create([
            'level_id' => $level4->id,
            'instruction' => 'Ubah kata pada soal menjadi Basa Ngoko atau Bahasa Indonesia',
            'question_text' => 'Karakter utawa paraga ing crita diarani...',
            'question_type' => 'multiple_choice',
        ]);
        QuestionOption::create(['question_id' => $q4_2->id, 'option_text' => 'Tokoh', 'is_correct' => true]);
        QuestionOption::create(['question_id' => $q4_2->id, 'option_text' => 'Latar', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q4_2->id, 'option_text' => 'Alur', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q4_2->id, 'option_text' => 'Tema', 'is_correct' => false]);

        $q4_3 = Question::create([
            'level_id' => $level4->id,
            'instruction' => 'Ubah kata pada soal menjadi Basa Ngoko atau Bahasa Indonesia',
            'question_text' => 'Piwulang becik sing bisa dijupuk saka crita diarani...',
            'question_type' => 'multiple_choice',
        ]);
        QuestionOption::create(['question_id' => $q4_3->id, 'option_text' => 'Amanat', 'is_correct' => true]);
        QuestionOption::create(['question_id' => $q4_3->id, 'option_text' => 'Latar', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q4_3->id, 'option_text' => 'Tokoh', 'is_correct' => false]);
        QuestionOption::create(['question_id' => $q4_3->id, 'option_text' => 'Alur', 'is_correct' => false]);
    }
}
