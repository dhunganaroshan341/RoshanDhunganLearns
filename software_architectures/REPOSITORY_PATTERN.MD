# Repository Pattern

- Separates data access logic from business logic.
- Acts as a mediator between the domain and data mapping layers.

## Example
- Interface: `UserRepositoryInterface`  
- Implementation: `UserRepository`  
- Usage in Service: inject repository instead of direct DB calls.
