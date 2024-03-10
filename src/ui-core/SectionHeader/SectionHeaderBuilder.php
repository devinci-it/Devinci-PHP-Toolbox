<?php

namespace Devinci\UICore\SectionHeader;

class SectionHeaderBuilder
{
    private $sectionHeader;

    public function __construct()
    {
        $this->sectionHeader = new SectionHeader('', '', '',[]); // Set default values or adjust as needed
    }

    public function setTitle($title): self
    {
        $this->sectionHeader->setTitle($title);
        return $this;
    }

    public function setLastModified($lastModified): self
    {
        $this->sectionHeader->setLastModified($lastModified);
        return $this;
    }

    public function setBreadcrumb($breadcrumb): self
    {
        $this->sectionHeader->setBreadcrumb($breadcrumb);
        return $this;
    }

    public function setBreadcrumbUrl($breadcrumb_url):self
    {
        $this->sectionHeader->setBreadcrumbUrl($breadcrumb_url);
        return $this;

    }

    public function build(): SectionHeader
    {
        return $this->sectionHeader;
    }
}