<x-app-layout>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>Company Details</h4>
                            <a href="{{ route('admin.company.create') }}" class="btn btn-primary">add new</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Company Name</th>
                                            <th>Logo</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                COde IT
                                            </td>
                                            <td>
                                                <img alt="image" src="/assets/img/users/user-5.png" width="35">
                                            </td>
                                            <td>
                                                hhhhhhhh@gmail.com
                                            </td>
                                            <td>
                                                123456789
                                            </td>
                                            <td><a href="#" class="btn btn-primary">Detail</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
