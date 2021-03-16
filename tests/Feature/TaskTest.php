<?php

namespace Tests\Feature;

use App\Http\Requests\CreateTask;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;


class TaskTest extends TestCase
{
  use RefreshDatabase;

  public function setUp(): void
  {
    parent::setUp();

    $this->seed('FoldersTableSeeder');
  }

  /**
   * @test
   */
  public function due_date_should_be_date()
  {
    // $this->withoutExceptionHandling();

    $response = $this->post('/folders/1/tasks/create', [
      'title' => 'Sample task',
      'due_date' => 123,
    ]);

    $response->assertSessionHasErrors(['期限日には日付を入力してください。']);
  }

  /**
   * @test
   */
  public function due_date_should_not_be_date()
  {
    // $this->withoutExceptionHandling();

    $response = $this->post('/folders/1/tasks/create', [
      'title' => 'Sample task',
      'due_date' => Carbon::yesterday()->format('Y/m/d'),
    ]);

    $response->assertSessionHasErrors([
      'due_date' => '期限日には今日以降の日付を入力してください。',
      ]);
  }

}
