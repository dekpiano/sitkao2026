<?php

namespace App\Controllers;

use App\Models\JobModel;

class Jobs extends BaseController
{
    public function index()
    {
        $model = new JobModel();
        $search = $this->request->getVar('search');
        $type   = $this->request->getVar('type');

        $builder = $model->where('job_status', 'open');

        if (!empty($search)) {
            $builder = $builder->groupStart()
                               ->like('job_title', $search)
                               ->orLike('job_company', $search)
                               ->orLike('job_location', $search)
                               ->orLike('job_description', $search)
                               ->groupEnd();
        }

        if (!empty($type)) {
            $builder = $builder->where('job_type', $type);
        }

        $jobs = $builder->orderBy('job_id', 'DESC')->findAll();

        $data = [
            'jobs'   => $jobs,
            'search' => $search,
            'type'   => $type
        ];

        return view('jobs/index', $data);
    }

    public function detail($id)
    {
        $model = new JobModel();
        $job = $model->find($id);

        if (!$job) {
            return redirect()->to('/jobs')->with('error', 'ไม่พบประกาศรับสมัครงานที่ต้องการ');
        }

        $data = [
            'job'         => $job,
            'recentJobs'  => $model->where('job_id !=', $id)->where('job_status', 'open')->orderBy('job_id', 'DESC')->limit(4)->findAll()
        ];

        return view('jobs/detail', $data);
    }

    public function create()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('msg', 'กรุณาเข้าสู่ระบบก่อนลงประกาศรับสมัครงาน');
        }

        return view('jobs/create');
    }

    public function save()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $rules = [
            'job_title'       => 'required|min_length[3]',
            'job_company'     => 'required',
            'job_contact'     => 'required',
            'job_description' => 'required'
        ];

        if ($this->validate($rules)) {
            $model = new JobModel();
            $model->insert([
                'job_title'          => $this->request->getVar('job_title'),
                'job_company'        => $this->request->getVar('job_company'),
                'job_location'       => $this->request->getVar('job_location'),
                'job_type'           => $this->request->getVar('job_type') ?? 'Full-time',
                'job_salary'         => $this->request->getVar('job_salary'),
                'job_description'    => $this->request->getVar('job_description'),
                'job_qualifications' => $this->request->getVar('job_qualifications'),
                'job_contact'        => $this->request->getVar('job_contact'),
                'job_contact_email'  => $this->request->getVar('job_contact_email'),
                'job_contact_phone'  => $this->request->getVar('job_contact_phone'),
                'job_author_id'      => $session->get('id'),
                'job_status'         => 'open'
            ]);

            return redirect()->to('/jobs')->with('msg', 'ลงประกาศรับสมัครงานสำเร็จแล้ว!');
        } else {
            return redirect()->back()->withInput()->with('error', 'กรุณากรอกข้อมูลสำคัญให้ครบถ้วน');
        }
    }
}
