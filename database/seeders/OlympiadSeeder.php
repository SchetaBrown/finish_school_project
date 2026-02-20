<?php

namespace Database\Seeders;

use App\Models\Olympiad;
use Illuminate\Database\Seeder;

class OlympiadSeeder extends Seeder
{
    private array $olympiads = [
        [
            'title' => 'Основы программирования на VueJS',
            'description' => 'Олимпиада по созданию интерактивных веб-интерфейсов с использованием фреймворка VueJS. Участники освоят реактивность, компоненты и управление состоянием, решая задачи на построение динамических UI.',
            'start_date' => '2025-11-23',
            'end_date' => '2025-11-30',
            'player_count' => 28,
            'player_limit' => 50,
            'olympiad_status_id' => 2,
            'olympiad_direction_id' => 1,
        ],
        [
            'title' => 'Разработка ИС на Laravel',
            'description' => 'Олимпиада по backend-разработке на PHP-фреймворке Laravel. Участники будут проектировать архитектуру, работать с базами данных, API и реализовывать бизнес-логику для комплексных информационных систем.',
            'start_date' => '2026-01-14',
            'end_date' => '2026-01-18',
            'player_count' => 14,
            'player_limit' => 30,
            'olympiad_status_id' => 2,
            'olympiad_direction_id' => 1,
        ],
        [
            'title' => 'Дипломатия протоколов: проектирование RESTful API',
            'description' => 'Задачи этой олимпиады сфокусированы на архитектуре веб-сервисов. Участникам предстоит правильно применять HTTP-методы, статус-коды, проектировать ресурсы и их взаимосвязи, а также учитывать вопросы безопасности, версионирования и документирования API.',
            'start_date' => '2026-01-14',
            'end_date' => '2026-01-16',
            'player_count' => 78,
            'player_limit' => 100,
            'olympiad_status_id' => 3,
            'olympiad_direction_id' => 1,
        ],
        [
            'title' => 'Архитектурный код: паттерны проектирования на C#',
            'description' => 'Олимпиада для тех, кто хочет писать не просто работающий, но и элегантный, поддерживаемый код. Участникам предстоит решать типичные архитектурные проблемы, применяя классические паттерны (порождающие, структурные, поведенческие) в контексте языка C# и платформы .NET.',
            'start_date' => '2025-12-04',
            'end_date' => '2025-12-18',
            'player_count' => 40,
            'player_limit' => 40,
            'olympiad_status_id' => 3,
            'olympiad_direction_id' => 1,
        ],
        [
            'title' => 'DevOps-инструменты: автоматизация от CI/CD до контейнеризации',
            'description' => 'Олимпиада на стыке разработки и эксплуатации. Задания будут посвящены написанию скриптов для пайплайнов (GitLab CI/GitHub Actions), сборке Docker-образов, оркестрации и настройке мониторинга. Ключевой навык — умение автоматизировать рутину.',
            'start_date' => '2025-07-14',
            'end_date' => '2025-07-24',
            'player_count' => 7,
            'player_limit' => 20,
            'olympiad_status_id' => 4,
            'olympiad_direction_id' => 1,
        ],
    ];
    public function run(): void
    {
        foreach ($this->olympiads as $olympiad) {
            Olympiad::create($olympiad);
        }
    }
}
