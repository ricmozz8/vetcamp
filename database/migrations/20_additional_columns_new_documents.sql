ALTER TABLE applications
ADD COLUMN url_medical_plan VARCHAR(255) COLLATE utf8mb4_unicode_ci NULL,
ADD COLUMN url_payment_receipt VARCHAR(255) COLLATE utf8mb4_unicode_ci NULL,
ADD COLUMN url_liability_waiver VARCHAR(255) COLLATE utf8mb4_unicode_ci NULL;
