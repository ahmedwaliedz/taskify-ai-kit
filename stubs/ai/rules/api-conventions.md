# 🔌 API CONVENTIONS

## 📍 Versioning
- All API routes MUST be prefixed with `/api/v1/`.

## 📦 Responses
- **API Resources**: Mandatory. Never return Eloquent models or raw arrays.
- **Format** (Laravel default paginator):
  ```json
  {
    "data": [
      { "id": 1, "name": "Item 1" }
    ],
    "links": {
      "first": "http://api.test/api/v1/items?page=1",
      "last": "http://api.test/api/v1/items?page=10",
      "prev": null,
      "next": "http://api.test/api/v1/items?page=2"
    },
    "meta": {
      "current_page": 1,
      "from": 1,
      "last_page": 10,
      "per_page": 15,
      "to": 15,
      "total": 150
    }
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
