# 🔌 API CONVENTIONS

## 📍 Versioning
- All API routes MUST be prefixed with `/api/v1/`.

## 📦 Responses
- **API Resources**: Mandatory. Never return Eloquent models or raw arrays.
- **Format**:
  ```json
  {
    "data": { ... },
    "meta": { "version": "1.2" }
  }
  ```

## 🔍 List Standard (Filtering/Pagination)
- **Pagination**: Default Laravel `paginate()`.
- **Filters**: Use `->when()` for optional parameters.
- **Validation**:
  - `per_page`: `integer|min:1|max:100`.
  - `sort`: Whitelist columns.
  - `dir`: `in:asc,desc`.

## 🛡️ Validation
- Use `FormRequest` classes.
- Return `422 Unprocessable Entity` for validation errors.
