<?php


class Applicant implements SplObserver
{

    private string $name;
    private int $experience;
    private string $email;

    public function __construct(string $name, string $email, int $experience = 0)
    {
        $this->name = $name;
        $this->email = $email;
        $this->experience = $experience;
    }

    /**
     * @inheritDoc
     */
    public function update(SplSubject $subject)
    {
        echo "$this->name получил уведомление о появлении новой вакансии" . PHP_EOL;
    }

    public function attachToSubject(SplSubject $splSubject)
    {
        $splSubject->attach($this);
    }

    public function detachFromSubject(SplSubject $splSubject)
    {
        $splSubject->detach($this);
    }
}