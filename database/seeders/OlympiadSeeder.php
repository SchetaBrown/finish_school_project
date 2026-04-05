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
            'register_start_date' => '2025-10-01 00:00:00',
            'register_end_date' => '2025-11-20 23:59:59',
            'start_date' => '2025-11-23',
            'end_date' => '2025-11-30',
            'max_player_register_count' => 28,
            'slug' => '',
            'olympiad_status_id' => 2,
            'olympiad_maintainer_id' => 4,
            'olympiad_manager_id' => 4,
            'olympiad_direction_id' => 1,
        ],
        [
            'title' => 'Разработка ИС на Laravel',
            'description' => 'Олимпиада по backend-разработке на PHP-фреймворке Laravel. Участники будут проектировать архитектуру, работать с базами данных, API и реализовывать бизнес-логику для комплексных информационных систем.',
            'register_start_date' => '2025-10-01 00:00:00',
            'register_end_date' => '2025-11-20 23:59:59',
            'start_date' => '2026-01-14',
            'end_date' => '2026-01-18',
            'max_player_register_count' => 14,
            'slug' => '',
            'olympiad_status_id' => 2,
            'olympiad_maintainer_id' => 4,
            'olympiad_manager_id' => 4,
            'olympiad_direction_id' => 1,
        ],
        [
            'title' => 'Дипломатия протоколов: проектирование RESTful API',
            'description' => 'Задачи этой олимпиады сфокусированы на архитектуре веб-сервисов. Участникам предстоит правильно применять HTTP-методы, статус-коды, проектировать ресурсы и их взаимосвязи, а также учитывать вопросы безопасности, версионирования и документирования API.',
            'register_start_date' => '2025-10-01 00:00:00',
            'register_end_date' => '2025-11-20 23:59:59',
            'start_date' => '2026-01-14',
            'end_date' => '2026-01-16',
            'max_player_register_count' => 78,
            'slug' => '',
            'olympiad_status_id' => 3,
            'olympiad_maintainer_id' => 4,
            'olympiad_manager_id' => 4,
            'olympiad_direction_id' => 1,
        ],
        [
            'title' => 'Архитектурный код: паттерны проектирования на C#',
            'description' => 'Олимпиада для тех, кто хочет писать не просто работающий, но и элегантный, поддерживаемый код. Участникам предстоит решать типичные архитектурные проблемы, применяя классические паттерны (порождающие, структурные, поведенческие) в контексте языка C# и платформы .NET.',
            'register_start_date' => '2025-10-01 00:00:00',
            'register_end_date' => '2025-11-20 23:59:59',
            'start_date' => '2025-12-04',
            'end_date' => '2025-12-18',
            'slug' => '',
            'max_player_register_count' => 40,
            'olympiad_status_id' => 3,
            'olympiad_maintainer_id' => 4,
            'olympiad_manager_id' => 4,
            'olympiad_direction_id' => 1,
        ],
        [
            'title' => 'DevOps-инструменты: автоматизация от CI/CD до контейнеризации',
            'description' => 'Олимпиада на стыке разработки и эксплуатации. Задания будут посвящены написанию скриптов для пайплайнов (GitLab CI/GitHub Actions), сборке Docker-образов, оркестрации и настройке мониторинга. Ключевой навык — умение автоматизировать рутину.',
            'register_start_date' => '2025-10-01 00:00:00',
            'register_end_date' => '2025-11-20 23:59:59',
            'start_date' => '2025-07-14',
            'end_date' => '2025-07-24',
            'slug' => '',
            'max_player_register_count' => 7,
            'olympiad_status_id' => 4,
            'olympiad_maintainer_id' => 4,
            'olympiad_manager_id' => 4,
            'olympiad_direction_id' => 1,
        ],
    ];
    public function run(): void
    {
        foreach ($this->olympiads as $olympiad) {
            if (!isset($olympiad['slug'])) {
                $olympiad['slug'] = 'olympiad-' . now()->timestamp . '-' . rand(1000, 9999);
            }

            Olympiad::create($olympiad);
        }
    }
}
