<?php

namespace Devinci\UICore\SectionHeader;

class SectionHeaderManager
{
    private $sectionHeaderBuilder;

    public function __construct()
    {
        $this->sectionHeaderBuilder = new SectionHeaderBuilder();
    }

    public function createSectionHeader($title, $lastModified, $breadcrumb,$breadcrumb_url): SectionHeader
    {
        return $this->sectionHeaderBuilder
            ->setTitle($title)
            ->setLastModified($lastModified)
            ->setBreadcrumb($breadcrumb)
            ->setBreadcrumbUrl($breadcrumb_url)
            ->build();
    }

    public function renderSectionHeader(SectionHeader $sectionHeader): string
    {
        return $sectionHeader->render();
    }
}
