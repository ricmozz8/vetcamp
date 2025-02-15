alter table applications
    modify status enum ('unsubmitted', 'submitted', 'need_changes', 'approved', 'denied', 'incomplete', 'waitlist') default 'submitted' null;

