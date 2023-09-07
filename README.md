# Test API Documentation

Explore the different endpoints provided by the Test API. This documentation guides you on how to effectively utilize each of them.

---

## 1. **Save User Endpoint**

**Endpoint:** `/api/save_user`

Use this endpoint to save a user's details.

**Method:** `POST`

**Command:**

```bash
curl --location 'localhost:8000/api/save_user' \
--form 'name="Noah"' \
--form 'email="noah@example.com"' \
--form 'role="ADMIN"' \
--form 'status="1"'\
--form 'mobile="+1 (424) 209 4782"' \
--form 'address="3480 Patterson Fork Road, Chicago"'
```

#### Parameters:

- **`name`**: User's full name.
- **`email`**: User's email address.
- **`role`**: Designated role for the user (Example: "tester").
- **`status`**: User's current status.
  - `1`: Active
  - `0`: Inactive
- **`mobile`**: User's mobile.
- **`address`**: User's address.

---

### 2. Send Event Endpoint

**Endpoint:** `/api/send_event`

Use this endpoint to save event name of the user.

**Method:** `POST`

**Command:**
```bash
curl --location 'localhost:8000/api/send_event' \
--form 'event_name="Monthly Report"'
```

##### Parameters:

- **`event_name`**: Name of the event.

---
Feel free to adjust any sections or add further information as required.
