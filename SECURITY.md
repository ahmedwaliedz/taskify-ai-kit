# Security Policy

## Supported Versions

| Version | Supported          |
| ------- | ------------------ |
| 1.2.x   | :white_check_mark: |
| 1.1.x   | :x:                |
| 1.0.x   | :x:                |

## Reporting a Vulnerability

If you discover a security vulnerability, please send an email to security@taskify.ai. All security vulnerabilities will be promptly addressed.

## Security Requirements

- `FormRequest` mandatory on all endpoints
- No `$request->all()` usage
- Explicit `$fillable` on all models
- Rate limiting on sensitive routes
- Zero PII logging (no passwords, tokens, emails in logs)