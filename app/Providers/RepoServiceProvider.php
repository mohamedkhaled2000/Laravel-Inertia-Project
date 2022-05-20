<?php

namespace App\Providers;

use  App\Http\Repository\Interface\TeacherRepositoryInterface;
use App\Http\Repository\TeacherRepository;
use App\Http\Repository\Interface\GradeRepositoryInterface;
use App\Http\Repository\GradeRepository;
use App\Http\Repository\Interface\ClassRoomRepositoryInterface;
use App\Http\Repository\ClassRoomRepository;
use App\Http\Repository\Interface\SectionRepositoryInterface;
use App\Http\Repository\SectionRepository;
use App\Http\Repository\Interface\ParentRepositoryInterface;
use App\Http\Repository\ParentRepository;
use App\Http\Repository\Interface\StudentRepositoryInterface;
use App\Http\Repository\StudentRepository;
use App\Http\Repository\Interface\PromotionRepositoryInterface;
use App\Http\Repository\PromotionRepository;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->registerTeacher();
        $this->registerGrade();
        $this->registerClassRoom();
        $this->registerSection();
        $this->registerParent();
        $this->registerStudent();
        $this->registerPromotion();
    }

    public function registerTeacher(){
        return $this->app->bind(
            TeacherRepositoryInterface::class,
            TeacherRepository::class);
    }

    public function registerGrade(){
        return $this->app->bind(
            GradeRepositoryInterface::class,
            GradeRepository::class);
    }

    public function registerClassRoom(){
        return $this->app->bind(
            ClassRoomRepositoryInterface::class,
            ClassRoomRepository::class);
    }
    public function registerSection(){
        return $this->app->bind(
            SectionRepositoryInterface::class,
            SectionRepository::class);
    }
    public function registerParent(){
        return $this->app->bind(
            ParentRepositoryInterface::class,
            ParentRepository::class);
    }
    public function registerStudent(){
        return $this->app->bind(
            StudentRepositoryInterface::class,
            StudentRepository::class);
    }
    public function registerPromotion(){
        return $this->app->bind(
            PromotionRepositoryInterface::class,
            PromotionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
