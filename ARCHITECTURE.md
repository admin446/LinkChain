# 多分店會員管理系統 架構規範 (ARCHITECTURE.md)

## 1. 專案核心架構 (System Architecture)
本系統採用 **Service-Action Pattern**，旨在落實單一職責原則 (SRP)，確保商業邏輯與 HTTP 傳輸層完全解耦。

* **Actions (`app/Actions/`)**：處理單一、不可分割的業務動作（例如建立會員、XLS 檔案匯出與匯入等），必須設計為無狀態 (Stateless)。
* **Services (`app/Services/`)**：封裝跨模組的複雜邏輯或多個 Action 的組合操作。
* **Models (`app/Models/`)**：僅限於定義資料表屬性、Eloquent 關聯與簡單的資料存取 Scope。
* **Form Requests (`app/Http/Requests/`)**：負責第一線的資料格式驗證與基礎權限檢查。

## 2. 語言與在地化規範 (i18n & Localization)
本系統以 **繁體中文 (zh_TW)** 為主要開發語言。

* **預設語言**：所有 Blade 視圖、硬編碼字串應以繁體中文撰寫，確保開發直觀性。
* **多國語言支援**：翻譯檔案必須存放在 `lang/{locale}/`。
* **統一配置**：系統頁尾 (Footer)、開發者標籤等統一存放於 `config/app.php`，嚴禁硬編碼於視圖中。

## 3. 技術棧規範 (Technology Stack)
* **PHP**：8.3。核心類別必須優先使用 `readonly class` 屬性提升穩定性。
* **核心框架**：Laravel 12.x。
* **資料庫**：原生支援 SQLite、MySQL、MariaDB、PostgreSQL 及 SQL Server。
* **UI 框架**：AdminLTE v4 (Bootstrap 5 / Vanilla JS)，嚴禁依賴 jQuery。
* **渲染模式**：伺服器端 Blade 渲染為主，Alpine.js 處理輕量前端互動。
* **色系控制**：支援 **Dark Mode 自適應**。

## 4. 多分店與權限體系 (Multi-Branch RBAC)
系統必須嚴格隔離不同店點的資料，權限判定優先讀取 `app/Enums/UserRole.php`。

* **總部管理員 (System Admin)**：具備最高權限，可管理所有分店、調整全局配置。
* **店點管理員 (Branch User)**：僅能存取其所屬店點 (Branch) 的會員資料與異動紀錄。
* **登入規範**：支援 `username` 或 `email` 雙軌登入。
* **資料隔離**：所有會員查詢必須自動掛載分店篩選條件（可透過 Global Scope 實作），確保數據合規性。

## 5. IDE 兼容性與強型別開發 (IDE & Type Hinting)
為解決 Intelephense 等靜態分析工具對 Laravel 輔助函式解析不準確導致的紅線錯誤，全站開發應遵循以下標準：

### (1) 身份驗證獲取規範
* **Controller 內**：禁止使用全域 `auth()->user()`。應透過 `Illuminate\Http\Request` 注入並調用 `$request->user()`。
* **FormRequest 內**：應直接使用 `$this->user()` 取代全域輔助函式。

### (2) PHPDoc 型別標註要求
獲取當前使用者實體後，必須顯式使用 PHPDoc 標註型別為 `\App\Models\User`，以確保 IDE 能正確索引自定義方法（如 `isAdmin()`）。
```php
/** @var \App\Models\User $user */
$user = $request->user();

if ($user && $user->isAdmin()) { ... }
```

### (3) 嚴格型別宣告
所有新建立的 PHP 檔案（Action, Service, Controller, Request）必須在檔案開頭宣告 `declare(strict_types=1);`。
```php
declare(strict_types=1);
```

## 6. 環境與通訊協議 (Environment & Protocol)
系統必須確保 URL 生成的動態適應性，以支援企業內部環境 (Intranet) 與外部 SSL (HTTPS) 環境共存。

* **混合協議支援**：禁止在代碼中硬編碼 `http` 或 `https` 協定標頭。
* **實作要求**：開發者需於 `AppServiceProvider` 的 `boot` 方法中，偵測伺服器變數並強制調用 `URL::forceScheme('https')`，以確保 `route()` 與 `asset()` 函數在 SSL 模式下不產生 Mixed Content 錯誤。

## 7. UI 與交互規範 (UI/UX Standards)

### (1) 佈局標準
* **目錄結構**：視圖檔案必須遵循 `resources/views/{zone}/{module}/` 格式定義。
* **表格標準**：統一使用 `.card > .card-body > .table-responsive` 結構以確保移動端自適應。
* **主題兼容**：應使用主題自適應類別（如 `bg-body`, `text-body`）以支援亮暗色系切換。

### (2) 通知與回饋規範
| 訊息類型 | 建議工具 | 呈現位置 | 備註 |
| :--- | :--- | :--- | :--- |
| 操作成功 | SweetAlert2 / Toast | 右上角 | 自動消失 (3–5 秒) |
| 操作失敗 | SweetAlert2 | 中央 | 需手動關閉，確保使用者知曉原因 |
| 表單錯誤 | BS5 `.invalid-feedback` | 欄位下方 | 配合 `is-invalid` 類別使用 |

## 8. 目錄結構與權責定義
* **`app/Actions/Member/`**：存放會員註冊、狀態更新 Action。
* **`app/Actions/Export/`** & **`app/Actions/Import/`**：存放 XLS 等報表格式的匯出與匯入 Action。
* **`app/Enums/`**：存放所有強型別定義，如 `UserRole`、`MemberStatus` 等。
* **`resources/views/admin/`**：後台管理介面視圖，`layouts/` 存放母版，`partials/` 存放共用子組件。
