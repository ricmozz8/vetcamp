alter table applications
    modify status enum ('unsubmitted', 'submitted', 'need_changes', 'approved', 'denied', 'incomplete', 'waitlist', 'enrolled') default 'submitted' null;

