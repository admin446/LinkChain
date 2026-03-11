# 多分店會員管理系統 (Multi-Branch Member Management System)

本系統專為多實體店面、跨據點的會員管理需求所打造。核心架構落實單一職責原則 (SRP)，透過嚴格的權限隔離與現代化的 PHP 開發規範，確保系統具備高擴展性、易維護性與資料安全性。

## 🌟 核心特色 (Features)

* **多分店資料隔離 (Multi-Branch RBAC)**：嚴格區分「總部管理員」與「店點管理員」權限，確保各分店僅能存取所屬的會員與異動紀錄。
* **企業級架構設計**：導入 Service-Action Pattern，將複雜商業邏輯自 Controller 抽離，提升代碼複用率與可測試性。
* **強型別與現代化語法**：全面採用 PHP 8.3 嚴格模式 (declare(strict_types=1);) 與 readonly class，大幅降低運行時錯誤。
* **報表整合能力**：支援會員資料與點數紀錄的 XLS 格式匯出與匯入功能。
* **響應式深色模式**：後台採用 AdminLTE v4 (Bootstrap 5) 搭配 Alpine.js，原生支援 Dark Mode 自適應切換。
* **容器化就緒 (Docker Ready)**：支援封裝為 Docker Hub 映像檔格式，實現本地開發與正式環境的高度一致性。

## 🛠️ 技術棧 (Tech Stack)

* **Backend**: PHP 8.3+, Laravel 12.x
* **Frontend**: Blade, AdminLTE v4, Alpine.js, Vanilla JS (無 jQuery)
* **Database**: SQLite (預設開發)、MySQL / PostgreSQL (正式環境)

## 📋 系統需求 (Prerequisites)

* PHP >= 8.3
* Composer >= 2.x
* Node.js >= 20.x & npm
* 支援的關聯式資料庫引擎

## 🚀 快速起步 (Getting Started)

### 1. 取得專案與安裝依賴

    git clone [repository-url]
    cd [project-folder]
    composer install
    npm install

### 2. 環境變數配置

複製 .env.example 並重新命名為 .env：

    cp .env.example .env

產生應用程式密鑰：

    php artisan key:generate

請確認 .env 中的資料庫連線設定。若本地開發使用 SQLite，請執行：

    touch database/database.sqlite

### 3. 資料庫遷移與填充

執行 Migration 建立資料表結構，並透過 Seeder 寫入預設的「總部管理員」帳號與基礎分店資料：

    php artisan migrate --seed

### 4. 編譯前端資源

    npm run build
    # 或在開發期間使用 npm run dev

### 5. 啟動本地伺服器

    php artisan serve

## 👨‍💻 開發者指南 (Developer Guide)

### 架構與命名規範
請所有參與開發的團隊成員，在提交 PR 前務必詳閱專案根目錄下的 ARCHITECTURE.md，確保代碼風格、型別標註與 UI 互動邏輯符合系統標準。

### IDE 智能提示 (IDE Helper)
為確保 VS Code (Intelephense) 或 PHPStorm 能精準解析 Laravel 輔助函式與 Model 屬性，我們已配置 laravel-ide-helper（僅限本地開發環境）。
每當新增 Model 欄位或更新套件後，建議執行以下指令更新提示檔：

    php artisan ide-helper:generate
    php artisan ide-helper:models -N
    php artisan ide-helper:meta

## 🐳 容器化部署 (Docker Deployment)
本專案支援 Docker 部署，詳細的映像檔建置與 docker-compose 啟動參數，請參考專案內的 Dockerfile 與環境變數說明。

## 📄 授權協議 (License)
[Proprietary / MIT / 依公司規定自行填寫]
