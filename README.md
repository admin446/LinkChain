# 多分店會員管理系統 (Multi-Branch Member Management System)

本系統專為多實體店面、跨據點的會員管理需求所打造。核心架構落實單一職責原則 (SRP)，透過嚴格的權限隔離與現代化的 PHP 開發規範，確保系統具備高擴展性、易維護性與資料安全性。

## 🌟 核心特色 (Features)

* **多分店資料隔離 (Multi-Branch RBAC)**：嚴格區分「總部管理員」與「店點管理員」權限，確保各分店僅能存取所屬的會員與異動紀錄。
* **企業級架構設計**：導入 Service-Action Pattern，將複雜商業邏輯（如 XLS 匯出/匯入）自 Controller 抽離，提升代碼複用率與可測試性。
* **強型別與現代化語法**：全面採用 PHP 8.3+，強制要求宣告 `declare(strict_types=1);` 並優先使用 `readonly class`，從源頭降低運行時錯誤。
* **極致的開發者體驗 (DX)**：規範嚴格的 PHPDoc 型別標註與身份驗證獲取方式，完美解決 Intelephense 等靜態分析工具的紅線解析痛點。
* **零前端建置依賴 (Zero Build Tools)**：後台採用 AdminLTE v4 (Bootstrap 5)，透過純 Blade 伺服器端渲染搭配 Vanilla JS 與 Alpine.js 處理輕量互動。原生支援 Dark Mode 自適應切換。
* **環境與安全自適應**：內建動態 HTTPS 強制轉換機制，完美兼容企業內部網路 (Intranet) 與外部 SSL (HTTPS) 混合環境。

## 🛠️ 技術棧 (Tech Stack)

* **Backend**: PHP 8.3+, Laravel 12.x
* **Frontend**: Pure Blade, AdminLTE v4 (Bootstrap 5), Alpine.js, Vanilla JS (嚴禁依賴 jQuery)
* **Database**: SQLite (開發預設支援)、MySQL, MariaDB, PostgreSQL, SQL Server

## 📋 系統需求 (Prerequisites)

* PHP >= 8.3
* Composer >= 2.x
* 支援的關聯式資料庫引擎

## 🚀 快速起步 (Getting Started)

### 1. 取得專案與安裝後端依賴

    git clone [repository-url]
    cd [project-folder]
    composer install

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

### 4. 啟動本地伺服器

    php artisan serve

## 👨‍💻 開發者指南 (Developer Guide)

### 架構與命名規範
請所有參與開發的團隊成員，在提交 PR 前務必詳閱專案根目錄下的 ARCHITECTURE.md，確保代碼風格、型別標註與 UI 互動邏輯符合系統標準。

### 語系與在地化 (i18n)
本系統預設採用繁體中文 (zh_TW) 開發。若需擴展多國語言，請將翻譯檔案統一放置於 `lang/{locale}/`，並確保系統配置統一於 `config/app.php` 讀取，嚴禁於視圖中硬編碼版權或系統名稱。

### IDE 智能提示 (IDE Helper)
為確保 VS Code (Intelephense) 或 PHPStorm 能精準解析 Laravel 輔助函式與 Model 屬性，專案已配置 laravel-ide-helper（僅限本地開發環境）。
每當新增 Model 欄位或更新套件後，建議執行以下指令更新提示檔：

    php artisan ide-helper:generate
    php artisan ide-helper:models -N
    php artisan ide-helper:meta

## 📄 授權協議 (License)
本專案基於 MIT License 授權使用。
